<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StudentTest;
use App\Models\Student;
use App\Models\Test;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentTestController extends Controller
{

    public function edit($id)
    {
        $resource = Resource::findOrFail($id);
        $test = Test::where('resource_id', $id)->first();
        // start count student time
        $studentTest = StudentTest::firstOrCreate(
            ['test_id' => $test->id, 'student_id' => Auth::user()->id, 'answer' => ' '],
            ['start_time' => now()]
        );
        return view('tests.edit', compact('resource', 'test', 'studentTest'));
    }


    public function submitTest(Request $request)
    {
        try {
            DB::beginTransaction();

            // Retrieve the student's test record
            $studentTest = StudentTest::where('student_id', Auth::id())
                ->where('test_id', $request->test_id)
                ->firstOrFail();

            // Update test details
            $studentTest->answer = $request['answer'];
            $submittedAt = now();
            $startTime = $studentTest->start_time;
            $isWithinTime = $startTime->diffInMinutes($submittedAt) <= 50;
            $studentTest->submitted_at = $submittedAt;
            $studentTest->submitted_within_time = $isWithinTime;
            $studentTest->save();

            // Check if resource_id is provided
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

            DB::commit();

            session()->flash('success', 'Test submitted and resource marked as viewed.');
            Log::info('Test submitted successfully for student ID: ' . Auth::id() . ' within time: ' . ($isWithinTime ? 'Yes' : 'No'));

            return redirect()->route('courses.myCourses')->with('success', 'Test submitted successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to submit test: ' . $e->getMessage());
            Log::error('Error submitting test: ' . $e->getMessage());
            return redirect()->route('courses.myCourses');
        }
    }


}
