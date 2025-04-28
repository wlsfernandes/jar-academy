<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AccessController extends Controller
{

    public function show()
    {
        return view('auth.terms');
    }
    public function index()
    {
        try {
            $users = User::where('institution_id', Auth::user()->institution_id)->get();
            return view('access.index', compact('users'));
        } catch (Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            session()->now('error', 'An error occurred while fetching users.');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('institution_id', Auth::user()->institution_id)
                ->findOrFail($id);

            $user->delete();
            DB::commit();
            return redirect()->route('access.index')->with('success', 'User deleted successfully!');

        } catch (Exception $e) {
            Log::error('Error deleting module and user: ' . $e->getMessage());
            return redirect()->route('modules.index')->with('error', 'An error occurred while deleting the module and user. Please try again.');
        }
    }

    public function accept(Request $request)
    {
        $request->validate([
            'accepted_terms' => 'accepted',
        ]);

        // Save in session (optional)
        session(['accepted_terms' => true]);

        // OR if user is logged in, save in database (optional)
        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'accepted_terms_at' => now(),
            ]);
        }
        return redirect('/index');

    }

    public function toggleFree(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);
                $user->is_free = !$user->is_free; // ✅ Simply invert true/false
                $user->save();
    
                Log::info('User updated successfully.', ['user_id' => $user->id]);
            });
    
            session()->flash('success', 'User updated successfully.');
            return redirect()->route('access.index');
        } catch (Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
    
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Failed to update user.'
            ]);
        }
    }
    


}
