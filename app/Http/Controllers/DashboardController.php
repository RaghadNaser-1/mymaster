<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch necessary data from your database or external APIs
        $userCount = User::count();
        $bookCount = Book::count();
        $authorCount = Author::count();
        $borrowCount = Borrow::count();

        // Pass the data to the view
        // return view('dashboard.index', compact('userCount', 'productCount', 'orderCount'));
        return view('dashboard.index', compact('userCount','bookCount','authorCount','borrowCount'));

    }

    public function users()
{
    $users = User::all(); // Retrieve all users from the `users` table

    return view('dashboard.users.users', compact('users'));
}

public function books()
{
    $books = Book::all(); // Retrieve all users from the `users` table

    return view('dashboard.books.index', compact('books'));
}
}
