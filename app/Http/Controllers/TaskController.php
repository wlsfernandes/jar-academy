<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\StorageS3;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Discipline;
use Exception;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    public function listMyTasks($disciplineId)
    {
        $discipline = Discipline::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($disciplineId);

        $studentId = Auth::id();

        $tasks = Task::where('discipline_id', $discipline->id)
            ->with([
                'studentTasks' => function ($query) use ($studentId) {
                    $query->where('student_id', $studentId);
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('disciplines.my-tasks', compact('discipline', 'tasks'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            DB::commit();
            return redirect()->back()->with('success', 'task deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting discipline: ' . $e->getMessage());
            return redirect()->back()->with('error', 'The delete process fail.');
        }
    }
}
