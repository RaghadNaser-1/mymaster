<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Repository;
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

    public function repository(Request $request)
    {
        $searchQuery = $request->input('search');

    // Perform the search query and retrieve the search results
    $searchResults = Repository::where('title', 'like', '%'.$searchQuery.'%')
        ->orWhere('author', 'like', '%'.$searchQuery.'%')
        ->get();

        return view('digital', compact('searchResults'));
    }
    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'file_path' => 'required',
    ]);

    // Create a new research item
    $research = new Repository();
    $research->title = $validatedData['title'];
    $research->author = $validatedData['author'];
    $research->file_path = $validatedData['file_path'];
    $research->save();

    // Optionally, you can redirect the user to a success page or return a response

    return redirect()->back()->with('success', 'Research added successfully!');
}
public function about()
    {



        return view('about');
    }

}
