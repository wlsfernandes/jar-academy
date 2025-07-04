<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Resource;
use App\Models\Student;
use App\Models\StudentTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\StorageS3;
use Exception;

class ResourceController extends Controller
{
    //$student->resources()->find($resource_id)->pivot->views;
    //$resources = $student->resources()->withPivot('views', 'last_viewed_at')->get();

    public function view(Resource $resource)
    {
        // $resource = Resource::findOrFail()
        //$student = Student::where('user_id', Auth::id())->firstOrFail();
        /* Check if the student already viewed the resource
        $viewedResource = $student->resources()->where('resource_id', $resource->id)->first();
        if ($viewedResource) {
            // If exists, increment views
            $student->resources()->updateExistingPivot($resource->id, [
                'views' => $viewedResource->pivot->views + 1,
                'last_viewed_at' => now()
            ]);
        } else {
            // First view, attach pivot with views = 1
            $student->resources()->attach($resource->id, [
                'views' => 1,
                'last_viewed_at' => now()
            ]);
        }
    */
        return view('resources.content-view', compact('resource'));

    }


    // Show form to edit a resources
    public function edit($id)
    {
        $resource = Resource::findOrFail($id);
        $resource_types = Resource::getResourceTypes();
        $types = Resource::getTypes();
        return view('resources.edit', compact('resource', 'resource_types', 'types'));
    }
    public function docs($id)
    {
        $resources = Resource::where('discipline_id', $id)
            ->where('resource_type', 'documento')
            ->get();

        return view('resources.docs', compact('resources'));
    }


    public function tasks($disciplineId)
    {
        $studentId = Auth::id();

        $tasks = Task::where('discipline_id', $disciplineId)
            ->with([
                'resource',
                'studentTasks' => function ($q) use ($studentId) {
                    $q->where('student_id', $studentId);
                }
            ])
            ->get();

        return view('resources.tasks', compact('tasks'));
    }

    public function tests($id)
    {
        $resources = Resource::where('discipline_id', $id)
            ->where('resource_type', 'prova')
            ->get();

        return view('resources.tests', compact('resources'));
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $resource = Resource::findOrFail($id);

            // Check if the resource is attached to a Task
            if ($resource->resourceable_type === Task::class) {
                // Delete the related Task
                $task = Task::find($resource->resourceable_id);
                if ($task) {
                    $task->delete();
                }
            }

            // Delete the resource
            $resource->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Resource and related task deleted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting resource: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while deleting the resource. Please try again.');
        }
    }




    // Update resources details in the database
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $resources = Resource::findOrFail($id);
            $file = $request->file('document');
            $url = $file ? StorageS3::uploadToS3($file) : null;

            $updateData = [
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'resource_type' => $request->input('resource_type'),
            ];

            if ($url) {
                $updateData['url'] = $url;
            }
            $resources->update($updateData);
            DB::commit();
            return redirect()->back()->with('success', 'resources updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating resources and user: ' . $e->getMessage(), [
                'exception' => $e,
                'resources_id' => $id,
                'resources_name' => $request->name,
                'resources_email' => $request->email,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Update resources: ']);
        }
    }
}
