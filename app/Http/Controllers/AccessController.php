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


}
