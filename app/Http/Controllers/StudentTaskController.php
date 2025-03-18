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
        $resource = Resource::findOrFail($id);
        $task = Task::where('resource_id', $id)->first();
        return view('tasks.edit', compact('resource', 'task'));
    }


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

            // Check if resource_id is provided
            if ($request->has('resource_id')) {
                $resourceId = $request->input('resource_id');

                // Ensure the resource exists
                $resource = Resource::find($resourceId);

                if ($resource) {
                    // Check if the student already viewed the resource
                    $studentResource = $student->resources()->where('resource_id', $resourceId)->first();

                    if ($studentResource) {
                        // If exists, increment views and update task_or_test_id with the new task ID
                        $student->resources()->updateExistingPivot($resourceId, [
                            'views' => $studentResource->pivot->views + 1,
                            'last_viewed_at' => now(),
                            'task_or_test_id' => $task->id, // Store the task ID
                        ]);
                    } else {
                        // First view, attach pivot with views = 1 and task ID
                        $student->resources()->attach($resourceId, [
                            'views' => 1,
                            'last_viewed_at' => now(),
                            'task_or_test_id' => $task->id, // Store the task ID
                        ]);
                    }
                } else {
                    throw new Exception("Resource not found.");
                }
            }

            DB::commit();

            session()->flash('success', 'Task added and resource marked as viewed.');
            Log::info('Task uploaded successfully and resource viewed.');

            return redirect()->back()->with('success', 'Task answered successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to create task: ' . $e->getMessage());
            Log::error('Error uploading task: ' . $e->getMessage());
            return redirect()->route('courses.myCourses');
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
                return redirect()->route('courses.myCourses');
            }
        }

    */


}
