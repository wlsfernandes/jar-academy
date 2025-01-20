<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StudentTask;
use App\Models\Task;
use App\Models\Resource;

class StudentTaskController extends Controller
{

    public function edit($id)
    {
        $resource = Resource::findOrFail($id);
        $task = Task::where('resource_id', $id);
        return view('tasks.edit', compact('resource', 'task'));
    }


    public function addTask(Request $request)
    {
        $test = StudentTask::create($request->all());

    }
}
