<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class TeacherController extends Controller
{
    // Display a list of teachers
    public function index()
    {
        $teachers = Teacher::where('institution_id', Auth::user()->institution_id)->get();
        return view('teachers.index', compact('teachers'));
    }

    // Show form to create a new teacher
    public function create()
    {
        return view('teachers.create');
    }
    // Show form to edit a teacher
    public function edit($id)
    {
        $teacher = Teacher::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    // Show details of a specific teacher
    public function show($id)
    {
        $teacher = Teacher::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }

    public function destroy($id)
    {
        try {
            $teacher = Teacher::where('institution_id', Auth::user()->institution_id)
                ->findOrFail($id);
            $user = $teacher->user;
            DB::transaction(function () use ($teacher, $user) {
                $teacher->delete();
                $user->delete();
            });
            return redirect()->route('teachers.index')->with('success', 'Teacher and User deleted successfully!');

        } catch (Exception $e) {
            Log::error('Error deleting teacher and user: ' . $e->getMessage());
            return redirect()->route('teachers.index')->with('error', 'An error occurred while deleting the teacher and user. Please try again.');
        }
    }

    // Store a new teacher in the database
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'teacher',
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'institution_id' => Auth::user()->institution_id, // Automatically set the institution ID
            ]);

            DB::commit();

            return redirect()->route('teachers.index')->with('success', 'Teacher created successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating teacher and user: ' . $e->getMessage(), [
                'exception' => $e,
                'teacher_name' => $request->name,
                'teacher_email' => $request->email,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the teacher. Please try again.']);
        }
    }

    // Update teacher details in the database
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $teacher = Teacher::findOrFail($id);
            $user = $teacher->user;
            $emailExists = User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists();

            if ($emailExists) {
                return redirect()->back()->withInput()->withErrors(['email' => 'The email has already been taken.']);
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->filled('password') ? bcrypt($request->password) : $user->password, // Update password only if provided
            ]);

            $teacher->update([
                'institution_id' => Auth::user()->institution_id,
            ]);

            DB::commit();

            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating teacher and user: ' . $e->getMessage(), [
                'exception' => $e,
                'teacher_id' => $id,
                'teacher_name' => $request->name,
                'teacher_email' => $request->email,
                'institution_id' => Auth::user()->institution_id,
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Update teacher: ']);
        }
    }


}
