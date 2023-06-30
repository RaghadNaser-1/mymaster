<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
{
    $books = Book::all(); // Retrieve all books from the database

    return view('books.index', compact('books'));
}

}
