<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Certification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
class BookController extends Controller
{
    public function addBook($id)
    {
        $certification = Certification::where('institution_id', Auth::user()->institution_id)
            ->where('id', $id)
            ->firstOrFail();

        return view('certifications.new-book', compact('certification'));
    }

    public function storeBook(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'book_url' => 'required|url|max:1000',
            'certification_id' => 'required|exists:certifications,id',
        ]);

        DB::beginTransaction();

        try {
            Book::create([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'book_url' => $request->input('book_url'),
                'certification_id' => $request->input('certification_id'),
                'institution_id' => auth()->user()->institution_id ?? auth()->id(), // fallback if null
            ]);

            DB::commit();

            return redirect()
                ->route('certifications.index')
                ->with('success', __('Book saved successfully!'));

        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Error saving book', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
                'title' => $request->title,
                'author' => $request->author,
                'book_url' => $request->book_url,
                'certification_id' => $request->certification_id,
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => __('An error occurred while saving the book. Please try again.')]);
        }
    }



}
