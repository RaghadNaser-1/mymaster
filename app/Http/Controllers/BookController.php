<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

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
        ->paginate(10);

    $categories = Category::all();

    return view('books.index', compact('books', 'categories'));
}

}
