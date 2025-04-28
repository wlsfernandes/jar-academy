<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CertificationController extends Controller
{
    // Display a list of certifications
    public function index()
    {
        $certifications = Certification::where('institution_id', Auth::user()->institution_id)
            ->orderBy('order')
            ->get();
        return view('certifications.index', compact('certifications'));
    }
    public function listCertifications()
    {
        $certifications = Certification::where('institution_id', Auth::user()->institution_id)
            ->orderBy('order')
            ->get();
        return view('certifications.list-certifications', compact('certifications'));
    }

    public function myCertifications()
    {
        $user = auth()->user();
        $student = $user->student;

        $certifications = $student->certifications()
            ->with('disciplines') // no need withPivot here
            ->orderBy('order')
            ->get();

        $paidDisciplineIds = $student->disciplines()
            ->wherePivot('is_paid', true)
            ->pluck('disciplines.id')
            ->toArray();

        return view('certifications.mycertifications', compact('certifications', 'paidDisciplineIds'));
    }





    // Show form to create a new certification
    public function create()
    {
        $certifications = Certification::orderBy('order')->get();
        return view('certifications.create', compact('certifications'));
    }
    // Show form to edit a certification
    public function edit($id)
    {
        $certification = Certification::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $certifications = Certification::where('institution_id', Auth::user()->institution_id)
            ->orderBy('order')
            ->get();
        return view('certifications.edit', compact('certification', 'certifications'));
    }

    // Show details of a specific certification
    public function show($id)
    {
        $certification = Certification::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        return view('certifications.show', compact('certification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $certification = Certification::where('institution_id', Auth::user()->institution_id)
                ->findOrFail($id);

            $certification->delete();
            DB::commit();
            return redirect()->route('certifications.index')->with('success', 'Certification deleted successfully!');

        } catch (Exception $e) {
            Log::error('Error deleting certification and user: ' . $e->getMessage());
            return redirect()->route('certifications.index')->with('error', 'An error occurred while deleting the certification and user. Please try again.');
        }
    }

    // Store a new certification in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
        DB::beginTransaction();

        try {

            Certification::create([
                'name' => $request->name,
                'amount' => $request->isFree ? 0 : $request->amount,
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
                'isFree' => $request->has('isFree'), // set true or false based on checkbox
                'order' => $request->order ?? 1,
                'parent_id' => $request->parent_id ?: null, // Optional parent
            ]);
            DB::commit();
            return redirect()->route('certifications.index')->with('success', 'Certification created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating certification and user: ' . $e->getMessage(), [
                'exception' => $e,
                'certification_name' => $request->name,
                'certification_email' => $request->email,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the certification. Please try again.']);
        }
    }

    // Update certification details in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
        DB::beginTransaction();

        try {
            $certification = Certification::findOrFail($id);

            $certification->update([
                'name' => $request->name,
                'amount' => $request->isFree ? 0 : $request->amount,
                'institution_id' => Auth::user()->institution_id,
                'isFree' => $request->has('isFree'),
                'order' => $request->order,
                'parent_id' => $request->parent_id ?: null, // Optional parent
            ]);
            DB::commit();
            return redirect()->route('certifications.index')->with('success', 'Certification updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating certification and user: ' . $e->getMessage(), [
                'exception' => $e,
                'certification_id' => $id,
                'certification_name' => $request->name,
                'certification_email' => $request->email,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Update certification: ']);
        }
    }

    public function registerFreeCertification(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $student = $user->student;
            $certificationId = $id;

            // Attach student to certification
            $student->certifications()->syncWithoutDetaching([$certificationId]);

            // Attach student to all disciplines in the certification with is_paid = true
            $certification = Certification::with('disciplines')->findOrFail($certificationId);
            foreach ($certification->disciplines as $discipline) {
                $student->disciplines()->syncWithoutDetaching([
                    $discipline->id => [
                        'is_paid' => false,
                    ]
                ]);
            }

            DB::commit();

            return redirect()
                ->route('certifications.listCertifications')
                ->with('success', 'Registration successful. You now have access to this Certification.');
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Error registering free certification: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => auth()->id(),
                'certification_id' => $id,
            ]);

            return redirect()->back()->withInput()->withErrors([
                'error' => 'An error occurred while registering the certification. Please try again.'
            ]);
        }
    }


}
