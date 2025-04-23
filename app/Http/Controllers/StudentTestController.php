<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StudentTest;
use App\Models\Student;
use App\Models\Discipline;
use App\Models\Test;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentTestController extends Controller
{

    public function edit($id)
    {
        $test = Test::findOrFail($id);

        // Get the student model (assuming the logged-in user has a student profile)
        $student = Auth::user()->student;

        if (!$student) {
            abort(403, 'Only students can take tests.');
        }

        // Ensure there's a StudentTest entry for this student/test
        $studentTest = StudentTest::firstOrCreate(
            [
                'test_id' => $test->id,
                'student_id' => $student->id,
            ],
            [
                'start_time' => now(),
            ]
        );
        // aqui 
        return view('tests.edit', compact('test', 'studentTest'));
    }
    public function show($id)
    {
        $submission = StudentTest::with(['student.user', 'test.discipline'])->findOrFail($id);

        return view('student_tests.view', compact('submission'));
    }

    public function submitTest(Request $request)
    {
        try {
            DB::beginTransaction();

            // ✅ Safely retrieve the student
            $student = Auth::user()->student;
            if (!$student) {
                throw new Exception('Student profile not found for the current user.');
            }

            // ✅ Retrieve StudentTest
            $studentTest = StudentTest::where('student_id', $student->id)
                ->where('test_id', $request->test_id)
                ->firstOrFail();

            // ✅ Save test submission
            $submittedAt = now();
            $startTime = $studentTest->start_time ?? $submittedAt;
            $isWithinTime = $startTime->diffInMinutes($submittedAt) <= 50;

            $studentTest->answer = $request->input('answer'); // Use input() for cleaner syntax
            $studentTest->submitted_at = $submittedAt;
            $studentTest->submitted_within_time = $isWithinTime;
            $studentTest->save();

            $test = $studentTest->test()->with('discipline')->first();
            $disciplineId = $test->discipline->id ?? null;

            if (!$disciplineId) {
                throw new Exception('Discipline not found for the test.');
            }
            // ✅ Sync discipline submission status
            $student->disciplines()->syncWithoutDetaching([
                $disciplineId => [
                    'is_submitted' => true,
                    'submitted_at' => $submittedAt,
                ]
            ]);
            // ✅ Check and mark certification completion
            $certificationId = $test->discipline->certification_id ?? null;
            if ($certificationId) {
                $student->checkAndCompleteCertification($certificationId);
            }

            DB::commit();

            session()->flash('success', 'Test submitted and resource marked as viewed.');
            Log::info('Test submitted for student ID: ' . Auth::id() . ' | Within time: ' . ($isWithinTime ? 'Yes' : 'No'));

            return redirect()->route('certifications.myCertifications')->with('success', 'Test submitted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to submit test: ' . $e->getMessage());
            Log::error('Error submitting test: ' . $e->getMessage());

            return redirect()->route('certifications.myCertifications');
        }
    }


    public function updateGrade(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required|numeric|min:0|max:10',
        ]);

        $studentTest = StudentTest::with('test.discipline.certification')->findOrFail($id);
        $studentTest->grade = $request->grade;
        $studentTest->save();

        $student = $studentTest->student;
        $certification = $studentTest->test->discipline->certification;

        // Get all disciplines for this certification
        $disciplines = $certification->disciplines;

        $allGraded = true;

        foreach ($disciplines as $discipline) {
            foreach ($discipline->tests as $test) {
                $submission = $student->testSubmissions
                    ->where('test_id', $test->id)
                    ->first();

                if (!$submission || $submission->grade === null) {
                    $allGraded = false;
                    break 2; // Exit both loops
                }
            }
        }

        if ($allGraded) {
            $student->certifications()
                ->updateExistingPivot($certification->id, [
                    'is_completed' => true,
                    'completed_at' => now(),
                ]);
        }

        return back()->with('success', 'Grade updated successfully.');
    }



}
// Check if resource_id is provided
/*
  if ($request->has('resource_id')) {
      $resourceId = $request->input('resource_id');

      // Ensure the resource exists
      $resource = Resource::find($resourceId);

      if ($resource) {
          // Get the student record
          $student = Student::where('user_id', Auth::id())->firstOrFail();

          // Check if the student already viewed the resource
          $studentResource = $student->resources()->where('resource_id', $resourceId)->first();

          if ($studentResource) {
              // If exists, increment views and update task_or_test_id with the test ID
              $student->resources()->updateExistingPivot($resourceId, [
                  'views' => $studentResource->pivot->views + 1,
                  'last_viewed_at' => now(),
                  'task_or_test_id' => $studentTest->id, // Store the test ID
              ]);
          } else {
              // First view, attach pivot with views = 1 and test ID
              $student->resources()->attach($resourceId, [
                  'views' => 1,
                  'last_viewed_at' => now(),
                  'task_or_test_id' => $studentTest->id, // Store the test ID
              ]);
          }
      } else {
          throw new Exception("Resource not found.");
      }
  }
*/