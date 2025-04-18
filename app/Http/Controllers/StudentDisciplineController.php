<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use Illuminate\Support\Facades\Auth;

class StudentDisciplineController extends Controller
{
    public function markDone(Request $request)
    {
        $request->validate([
            'discipline_id' => 'required|exists:disciplines,id',
        ]);

        $disciplineId = $request->discipline_id;

        $student = Auth::user()->student;

        // Update discipline progress in pivot
        $student->disciplines()->syncWithoutDetaching([
            $disciplineId => [
                'is_submitted' => true,
                'submitted_at' => now(),
            ]
        ]);

        // Check if all disciplines of the certification are submitted
        $certificationId = Discipline::find($disciplineId)->certification_id;
        $student->checkAndCompleteCertification($certificationId);

        return back()->with('success', 'Discipline marked as done!');
    }
}
