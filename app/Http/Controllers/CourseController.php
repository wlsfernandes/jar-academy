<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use App\Models\Module;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class CourseController extends Controller
{
    // Display a list of courses
    public function index()
    {
        $courses = Course::where('institution_id', Auth::user()->institution_id)->get();
        return view('courses.index', compact('courses'));
    }

    // Show form to create a new course
    public function create()
    {
        $modules = Module::where('institution_id', Auth::user()->institution_id)->get();
        return view('courses.create', compact('modules'));
    }
    // Show form to edit a course
    public function edit($id)
    {
        $course = Course::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $modules = Module::where('institution_id', Auth::user()->institution_id)->get();
        return view('courses.edit', compact('course', 'modules'));
    }



    // Show details of a specific course
    public function show($id)
    {
        $course = Course::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $modules = Module::where('institution_id', Auth::user()->institution_id)->get();
        return view('courses.show', compact('course', 'modules'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $course = Course::where('institution_id', Auth::user()->institution_id)->findOrFail($id);
            $course->delete();
            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting course: ' . $e->getMessage());

            return redirect()->route('courses.index')->with('error', 'An error occurred while deleting the course. Please try again.');
        }
    }


    // Store a new course in the database
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
            ]);
            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Course created successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating course and user: ' . $e->getMessage(), [
                'exception' => $e,
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the course. Please try again.']);
        }
    }

    // Update course details in the database
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $course = Course::findOrFail($id);

            $course->update([
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
            ]);
            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Course updated successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating course and user: ' . $e->getMessage(), [
                'exception' => $e,
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Update course: ']);
        }
    }

    public function resources($id)
    {
        $course = Course::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $resource_types = ['documento', 'prova', 'tarefa'];
        $types = ['audio', 'docx', 'pdf', 'power-point', 'video'];
        return view('courses.resources', compact('course', 'resource_types', 'types'));
    }
    public function homeworks($id)
    {
        $course = Course::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        return view('courses.homeworks', compact('course'));
    }

    public function addResource(Request $request, $id)
    {
        // Validate the file input
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
        try {
            DB::beginTransaction();

            $course = Course::findOrFail($id);

            $file = $request->file('document');

            if ($file->isValid()) {
                // Generate the file name and path
                $fileName = $course->omekaIdentifier . '.' . $file->getClientOriginalExtension();
                $path = $fileName;
                Storage::disk('s3')->put($path, file_get_contents($file));
                $url = Storage::cloud()->url($fileName);
                $course->save();

                Resource::create([
                    'course_id' => $course->id,
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'type' => $file->getClientOriginalExtension(),
                    'url' => $url,
                ]);

                DB::commit();
                session()->flash('success', 'Resource added successfully.');
                Log::info('Resource uploaded successfully.');
                return redirect()->route('courses.index');
            } else {
                DB::rollBack();
                return back()->withErrors(['document' => 'File upload error: ' . $file->getError()]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to upload file: ' . $e->getMessage());
            Log::error('Error uploading file: ' . $e->getMessage());
            return redirect()->route('courses.index');
        }
    }


}
