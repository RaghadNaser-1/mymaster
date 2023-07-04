<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
//     public function index()
// {
//     $books = Book::all(); // Retrieve all books from the database

//     return view('books.index', compact('books'));
// }

public function index(Request $request)
{
    $search = $request->input('search');
    $category = $request->input('category');

    $books = Book::query()
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($category, function ($query, $category) {
            $query->where('category_id', $category);
        })
        ->paginate(8);

    $categories = Category::all();

    return view('books.index', compact('books', 'categories'));
}
public function show(Book $book)
{
    return view('books.show', compact('book'));
}
public function borrow(Book $book)
{
    // Check if the book quantity is greater than 0
    if ($book->quantity > 0) {
        // Decrement the book quantity by one
        $book->quantity -= 1;
        $book->save();

        // Create a new borrowing record
        $borrow = new Borrow();
        $borrow->user_id = auth()->user()->id; // Assuming you have a user authentication system
        $borrow->book_id = $book->id;
        $borrow->borrowed_at = now();
        $borrow->estimated_end_time = Carbon::now()->addWeeks(2); // Set estimated_end_time to 2 weeks from now

        $borrow->save();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Book borrowed successfully.');
    } else {
        // Book quantity is 0, display an error message or handle the situation accordingly
        return redirect()->back()->with('error', 'Book is currently not available for borrowing.');
    }
}



}
