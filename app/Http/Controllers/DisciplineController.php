<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\Module;
use App\Models\Certification;
use App\Models\Student;
use App\Models\Task;
use App\Models\Test;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\StorageS3;
use Exception;

class DisciplineController extends Controller
{
    // Display a list of disciplines
    public function index()
    {
        $disciplines = Discipline::where('institution_id', Auth::user()->institution_id)
            ->orderBy('title')
            ->get();
        return view('disciplines.index', compact('disciplines'));
    }
    public function listDisciplines()
    {
        $disciplines = Discipline::where('institution_id', Auth::user()->institution_id)->get();
        return view('disciplines.listdisciplines', compact('disciplines'));
    }

    public function myDisciplines()
    {
        $disciplines = Discipline::where('institution_id', Auth::user()->institution_id)
            ->whereHas('students') // Ensures there are associated students in the discipline_student table
            ->get();

        return view('disciplines.mydisciplines', compact('disciplines'));
    }

    // Show form to create a new discipline
    public function create()
    {
        $modules = Module::where('institution_id', Auth::user()->institution_id)->get();
        $certifications = Certification::where('institution_id', Auth::user()->institution_id)->get();
        return view('disciplines.create', compact('modules', 'certifications'));
    }
    // Show form to edit a discipline
    public function edit($id)
    {
        $discipline = Discipline::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $modules = Module::where('institution_id', Auth::user()->institution_id)->get();
        $certifications = Certification::where('institution_id', Auth::user()->institution_id)->get();
        return view('disciplines.edit', compact('discipline', 'modules', 'certifications'));
    }



    // Show details of a specific discipline
    public function show($id)
    {
        $discipline = Discipline::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $modules = Module::where('institution_id', Auth::user()->institution_id)->get();
        $certifications = Certification::where('institution_id', Auth::user()->institution_id)->get();
        return view('disciplines.show', compact('discipline', 'modules', 'certifications'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $discipline = Discipline::where('institution_id', Auth::user()->institution_id)->findOrFail($id);
            $discipline->delete();
            DB::commit();
            return redirect()->route('disciplines.index')->with('success', 'Discipline deleted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting discipline: ' . $e->getMessage());

            return redirect()->route('disciplines.index')->with('error', 'An error occurred while deleting the discipline. Please try again.');
        }
    }


    // Store a new discipline in the database
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required_if:isFree,false|numeric|min:0',
            'isFree' => 'sometimes|boolean',
        ]);

        if (!$request->has('isFree') && floatval($request->amount) == 0) {
            return redirect()->back()->withInput()->withErrors(['amount' => 'Certification cannot have a price of 0 unless marked as free.']);
        }

        DB::beginTransaction();

        try {
            Discipline::create([
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'certification_id' => $request->certification,
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
                'amount' => $request->isFree ? 0 : $request->amount,
                'isFree' => $request->has('isFree'),
                'currency' => 'USD',
                'order' => $request->order ?? 1,
            ]);
            DB::commit();
            return redirect()->route('disciplines.index')->with('success', 'Discipline created successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating discipline and user: ' . $e->getMessage(), [
                'exception' => $e,
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'institution_id' => Auth::user()->institution_id,
                'amount' => $request->amount ?? 0.00,
                'currency' => 'USD',
                'order' => $request->order ?? 1,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the discipline. Please try again.']);
        }
    }

    // Update discipline details in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isFree' => 'sometimes|boolean',
            'amount' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->boolean('isFree') && !is_null($value) && $value > 0) {
                        $fail('You cannot set an amount when the item is marked as free.');
                    }

                    if (!$request->boolean('isFree') && (is_null($value) || $value <= 0)) {
                        $fail('Amount is required when the item is not free.');
                    }
                },
            ],
        ]);


        if (!$request->has('isFree') && floatval($request->amount) == 0) {
            return redirect()->back()->withInput()->withErrors(['amount' => 'Certification cannot have a price of 0 unless marked as free.']);
        }

        DB::beginTransaction();

        try {
            $discipline = Discipline::findOrFail($id);

            $discipline->update([
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'certification_id' => $request->certification,
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
                'amount' => $request->amount ?? 0.00,
                'isFree' => $request->has('isFree'),
                'currency' => 'USD',
                'order' => $request->order ?? 1,
            ]);
            DB::commit();
            return redirect()->route('disciplines.index')->with('success', 'Discipline updated successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating discipline and user: ' . $e->getMessage(), [
                'exception' => $e,
                'title' => $request->title,
                'description' => $request->description,
                'small_description' => $request->small_description,
                'module_id' => $request->module,
                'institution_id' => Auth::user()->institution_id,
                'amount' => $request->isFree ? 0 : $request->amount,
                'isFree' => $request->has('isFree'),
                'order' => $request->order ?? 1,

            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Update discipline: ']);
        }
    }

    public function resources($id)
    {
        $discipline = Discipline::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $resources = $discipline->resources;
        $resource_types = Resource::getResourceTypes();
        $types = Resource::getTypes();
        return view('disciplines.resources', compact('discipline', 'resources', 'resource_types', 'types'));
    }

    public function addResource(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $discipline = Discipline::findOrFail($id);

            $url = null;

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $url = StorageS3::uploadToS3($file);

                if (!$url) {
                    DB::rollBack();
                    return back()->withErrors(['document' => 'File upload failed.']);
                }
            } elseif ($request->filled('resource_url')) {
                $url = $request->input('resource_url');
            } else {
                DB::rollBack();
                return back()->withErrors(['resource_url' => 'You must provide either a file or a URL.']);
            }

            $resourceType = $request->input('resource_type');

            // Prepare resource data (excluding discipline_id for now, it will go through the relationship)
            $resourceData = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'resource_type' => $resourceType,
                'url' => $url,
            ];

            // Handle different resourceable types
            if ($resourceType === 'tarefa') {
                $task = Task::create([]);
                $task->resource()->create(array_merge($resourceData, [
                    'discipline_id' => $discipline->id,
                ]));
            } elseif ($resourceType === 'prova') {
                $test = Test::create([
                    'discipline_id' => $discipline->id,
                ]);
                $test->resource()->create(array_merge($resourceData, [
                    'discipline_id' => $discipline->id,
                ]));
            } else {
                // Non-polymorphic resource (e.g., a generic PDF, audio, etc.)
                Resource::create(array_merge($resourceData, [
                    'discipline_id' => $discipline->id,
                ]));
            }


            DB::commit();

            session()->flash('success', 'Resource added successfully.');
            Log::info('Resource uploaded successfully.');

            return redirect()->back()->with('success', 'Resource created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to upload resource: ' . $e->getMessage());
            Log::error('Error uploading resource: ' . $e->getMessage());

            return redirect()->route('disciplines.index');
        }
    }



    public function enroll($id)
    {
        $discipline = Discipline::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        return view('disciplines.enroll', compact('discipline'));
    }

    public function registerFreeCertification(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $student = $user->student;
            $studentId = $student->id;
            $disciplineId = $id;

            // Associate student with the discipline
            $student = Student::find($studentId);
            $student->disciplines()->attach($disciplineId, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::commit();
            return redirect()->route('disciplines.listDisciplines')->with('success', 'Register successful. You now have access to this Discipline.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating certification and user: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the discipline. Please try again.']);
        }
    }

}
