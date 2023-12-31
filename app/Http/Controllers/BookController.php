<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{


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
        ->paginate(9);

    $categories = Category::all();

    return view('books.index', compact('books', 'categories'));
}
// public function show(Book $book)
// {
//     return view('books.show', compact('book'));
// }

public function show($id)
{
    $book = Book::with('category', 'reviews.user')->findOrFail($id);
    $relatedBooks = Book::where('category_id', $book->category_id)
                        ->where('id', '!=', $book->id)
                        ->take(4)
                        ->get();
    return view('books.show', compact('book', 'relatedBooks'));
}

public function borrow(Book $book)
{
    if ($this->getUserBorrowedBooksCount() >= 3) {
        return redirect()->back()->with('error', 'You have reached the maximum limit of borrowed books.');
    }
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
private function getUserBorrowedBooksCount()
{
    $user = Auth::user();
    return $user->borrows()->where('returned', false)->count();
}
public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.books.edit', compact('book', 'categories'));
    }

public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'description' => 'required',
        'category' => 'required',
        'image' => 'required',
        'featured' => 'required',
        'quantity' => 'required|integer|min:0',
    ]);

    $book->title = $request->title;
    $book->author = $request->author;
    $book->description = $request->description;
    $book->category_id = $request->category;
    $book->image = $request->image;
    $book->featured = $request->featured;
    $book->quantity = $request->quantity;
    $book->save();

    // $books = Book::all(); // Retrieve all users from the `users` table

    return redirect()->route('bookstable')->with('success', 'Book updated successfully.');
    // return view('dashboard.books', compact('books'));

}
public function destroy( $id)
    {
        $book = Book::findOrFail($id);

        $book->delete();
        // return redirect()->route('bookstable')->with('success', 'Book deleted successfully.');
        return back()->with('success', 'Book deleted successfully.');


    }
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.books.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required',
            'featured' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->category_id = $request->category;
        $book->image = $request->image;
        $book->featured = $request->featured;
        $book->quantity = $request->quantity;
        $book->save();

        return redirect()->route('bookstable')->with('success', 'Book added successfully.');
    }
    public function favorite(Book $book)
{
    $user = Auth::user();

    // Check if the book is not already in the user's favorites
    if (!$user->favorites->contains($book->id)) {
        // Attach the book to the user's favorites
        $user->favorites()->attach($book);
        return redirect()->back()->with('success', 'Book added to favorites.');
    }

    // Redirect or return a response as needed
    return redirect()->back()->with('error', 'Book is already in favorites.');
}

public function unfavorite(Book $book)
{
    $user = auth()->user();

    // Detach the book from the user's favorites
    $user->favorites()->detach($book);

    return redirect()->back()->with('success', 'Book removed from favorites successfully!');
}

public function renew($id)
{
    $borrow = Borrow::find($id);

    if ($borrow && $borrow->isEligibleForRenewal()) {
        // Convert estimated_end_time to a Carbon instance
        $estimatedEndTime = Carbon::parse($borrow->estimated_end_time);

        // Calculate the new estimated_end_time by adding a week
        $newEstimatedEndTime = $estimatedEndTime->addWeek();

        // Update the borrow's estimated_end_time and increment renewals
        $borrow->estimated_end_time = $newEstimatedEndTime;
        $borrow->renewals += 1;
        $borrow->save();

        return redirect()->back()->with('success', 'Book renewed successfully.');
    } else {
        return redirect()->back()->with('error', 'Book is not eligible for renewal.');
    }
}




}
