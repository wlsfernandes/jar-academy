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

    // Store a new teacher in the database
    public function store(Request $request)
    {
        DB::beginTransaction(); 

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

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
            return redirect()->route('teachers.index')->with('error', 'An error occurred while creating the teacher. Please try again.');
        }
    }


    // Show details of a specific teacher
    public function show($id)
    {
        $teacher = User::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }

    // Show form to edit a teacher
    public function edit($id)
    {
        $teacher = User::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    // Update teacher details in the database
    public function update(Request $request, $id)
    {
        $teacher = User::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
        ]);

        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    // Delete a teacher
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
}
