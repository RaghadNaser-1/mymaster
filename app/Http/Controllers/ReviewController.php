<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request, Book $book)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:255',
    ]);

    $review = new Review();
    $review->user_id = auth()->id();
    $review->book_id = $book->id;
    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $review->save();

    return redirect()->back()->with('success', 'Review added successfully.');
}

public function edit(Review $review)
{
    return view('reviews.edit', compact('review'));
}

public function update(Request $request, Review $review)
{
    // Implement logic to update the review in the database
}

public function destroy(Review $review)
{
    $review->delete();

    return redirect()->route('reviews.index')->with('success', 'review deleted successfully.');
}
}
