<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Add logic to fetch data or perform any other necessary operations

        // Example: Retrieve some books and pass them to the view
        $categories = Category::all(); // Retrieve all categories from the database
        $featuredBooks = Book::where('featured', true)->limit(3)->get();

        return view('index',compact('categories','featuredBooks'));
    }
}
