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
    // public function index()
    // {
    //     // Retrieve all borrows
    //     $borrows = Borrow::paginate(9);

    //     return view('borrows.index', compact('borrows'));
    // }
    public function index(Request $request)
{
    $query = Borrow::query()->with(['book', 'user']);

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->whereHas('book', function ($subquery) use ($searchTerm) {
            $subquery->where('title', 'like', '%' . $searchTerm . '%');
        })->orWhereHas('user', function ($subquery) use ($searchTerm) {
            $subquery->where('name', 'like', '%' . $searchTerm . '%');
        });
    }

    $borrows = $query->paginate(9); // Adjust the pagination size as needed

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
    $borrow = new Borrow();
    $borrow->book_id = $validatedData['book_id'];
    $borrow->user_id = $validatedData['user_id'];
    $borrow->borrowed_at = $validatedData['borrowed_at'];
    $borrow->estimated_end_time = $validatedData['estimated_end_time'];
    $borrow->save();

    // Update the book quantity
    $book = Book::find($validatedData['book_id']);
    $book->quantity -= 1;
    $book->save();

    // Redirect or return a response as needed
    return redirect()->route('borrows.index')->with('success', 'Borrow created successfully!');
}


    public function show(Borrow $borrow)
    {
        // Retrieve the borrow record and related data

        return view('borrows.show', compact('borrow'));
    }

    public function edit(Borrow $borrow)
    {
        // Provide data for editing the borrow record (e.g., available books, users)
        $books = Book::all(); // Retrieve all books

        return view('borrows.edit', compact('borrow','books'));
    }

    // public function update(Request $request, Borrow $borrow)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'book_id' => 'required',
    //         'user_id' => 'required',
    //         'borrowed_at' => 'required',
    //         'return_date' => 'required',
    //     ]);

    //     // Update the borrow record
    //     $borrow->update($validatedData);

    //     // Redirect or return a response as needed
    //     return redirect()->route('borrows.index')->with('success', 'Borrow record updated successfully.');
    // }
    public function update(Request $request, Borrow $borrow)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'returned' => 'required|boolean',
        ]);

        // Update the borrow record
        $borrow->returned = $validatedData['returned'];
        $borrow->save();
        $book = $borrow->book;
        $book->quantity += 1;
        $book->save();
        // Redirect or return a response as needed
        return redirect()->route('borrows.index')->with('success', 'Borrow record updated successfully!');
    }

    public function destroy(Borrow $borrow)
    {
        // Delete the borrow record
        $borrow->delete();

        // Redirect or return a response as needed
        return redirect()->route('borrows.index')->with('success', 'Borrow record deleted successfully.');
    }
    public function return(Borrow $borrow)
{
    // Update the borrowed book status to returned
    $borrow->returned = true;
    $borrow->returned_at = now();
    $borrow->save();

    // Increase the quantity of the book by one
    $book = $borrow->book;
    $book->quantity += 1;
    $book->save();

    // Redirect or return a response as needed
    return redirect()->back()->with('success', 'Book returned successfully.');
}

}
