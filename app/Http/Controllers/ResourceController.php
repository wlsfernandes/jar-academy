<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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


    public function tasks($id)
    {
        $studentId = Auth::id();

        $resources = Resource::where('discipline_id', $id)
            ->where('resource_type', 'tarefa')
            ->with('resourceable') // Load Task relation
            ->get();

        // Attach answered status manually
        foreach ($resources as $resource) {
            $task = $resource->resourceable;

            // Add a dynamic property `answered`
            $resource->answered = $task && StudentTask::where('student_id', $studentId)
                ->where('task_id', $task->id ?? 0)
                ->exists();
        }

        return view('resources.tasks', compact('resources'));
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
            $resources = Resource::findOrFail($id);
            $resources->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Resources deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting resources and user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the resources and user. Please try again.');
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
