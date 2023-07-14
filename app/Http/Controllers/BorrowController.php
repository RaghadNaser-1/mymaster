<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;



class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all borrows
        $borrows = Borrow::all();

        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $books = Book::where('quantity', '>', 0)->get(); // Fetch available books
        $users = User::all(); // Fetch all users

        return view('borrows.create', compact('books', 'users'));
    }


    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'borrowed_at' => 'required',
            'estimated_end_time' => 'required',
        ]);

        // Create a new borrow record
        $borrow = Borrow::create($validatedData);

        // Redirect or return a response as needed
        return redirect()->route('borrows.index')->with('success', 'Borrow record created successfully.');
    }

    public function show(Borrow $borrow)
    {
        // Retrieve the borrow record and related data

        return view('borrows.show', compact('borrow'));
    }

    public function edit(Borrow $borrow)
    {
        // Provide data for editing the borrow record (e.g., available books, users)

        return view('borrows.edit', compact('borrow'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'borrowed_at' => 'required',
            'return_date' => 'required',
        ]);

        // Update the borrow record
        $borrow->update($validatedData);

        // Redirect or return a response as needed
        return redirect()->route('borrows.index')->with('success', 'Borrow record updated successfully.');
    }

    public function destroy(Borrow $borrow)
    {
        // Delete the borrow record
        $borrow->delete();

        // Redirect or return a response as needed
        return redirect()->route('borrows.index')->with('success', 'Borrow record deleted successfully.');
    }
}
