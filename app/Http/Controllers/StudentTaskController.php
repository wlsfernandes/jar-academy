<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StudentTask;
use App\Models\Task;
use App\Models\Student;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentTaskController extends Controller
{

    public function edit($id)
    {
        $task = Task::with('resource')->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    /*
 public function edit($id)
    {
        $resource = Resource::findOrFail($id);
        $task = Task::where('discipline_id', $resource->discipline->id)->first();
        return view('tasks.edit', compact('resource', 'task'));
    }
    */
    public function addTask(Request $request)
    {
        $request->validate([
            'answer' => 'required|string|min:1',
        ]);
        try {
            DB::beginTransaction();

            // Get the logged-in user
            $user = Auth::user();

            // Ensure the student exists for this user
            $student = Student::where('user_id', $user->id)->first();

            if (!$student) {
                throw new Exception("No student profile found for this user.");
            }

            // Store the task
            $requestData = $request->all();
            $requestData['student_id'] = Auth::user()->id;
            $task = StudentTask::create($requestData); // Create the task and get the task ID

            DB::commit();

            session()->flash('success', 'Task added and resource marked as viewed.');
            Log::info('Task uploaded successfully and resource viewed.');
            return redirect()->route('certifications.myCertifications')->with('success', 'Task answered successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to create task: ' . $e->getMessage());
            Log::error('Error uploading task: ' . $e->getMessage());
            return redirect()->route('certifications.myCertifications');
        }
    }




    /*
    public function addTask(Request $request)
        {
            try {
                DB::beginTransaction();
                $requestData = $request->all();
                $requestData['student_id'] = Auth::user()->id;
                StudentTask::create($requestData);
                DB::commit();
                session()->flash('success', 'Task added successfully.');
                Log::info('Task uploaded successfully.');
                return redirect()->back()->with('success', 'Task answered successfully!');
            } catch (Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Failed to create task file: ' . $e->getMessage());
                Log::error('Error uploading file: ' . $e->getMessage());
                return redirect()->route('certifications.myCertifications');
            }
        }

    */


}
