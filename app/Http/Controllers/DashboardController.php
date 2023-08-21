<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch necessary data from your database or external APIs
        // $userCount = User::count();
        $userCount = User::where('role_id', 2)->count();

        $bookCount = Book::count();
        $authorCount = Author::count();
        $borrowCount = Borrow::count();
        $mostBorrowedBook = Book::withCount('borrows')
        ->orderBy('borrows_count', 'desc')
        ->first();
        $mostBorrowedUser = User::withCount('borrows')
        ->orderByDesc('borrows_count')
        ->first();

        $borrowsPerMonth = Borrow::selectRaw("DATE_FORMAT(borrowed_at, '%Y-%m') AS month, COUNT(*) AS count")
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        $newUsersPerMonth = User::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS month,  COUNT(*) as count"))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        // Pass the data to the view
        return view('dashboard.index', compact('userCount','bookCount','authorCount','borrowCount','mostBorrowedBook','mostBorrowedUser','borrowsPerMonth','newUsersPerMonth'));

    }

//     public function users()
// {
//     // $users = User::all(); // Retrieve all users from the `users` table
//     $users = User::where('role_id', 2)->paginate(9);


//     return view('dashboard.users.users', compact('users'));
// }

public function users(Request $request)
{
    $query = User::query();

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->input('search') . '%')
              ->orWhere('email', 'like', '%' . $request->input('search') . '%');
    }

    $users = $query->paginate(9);

    return view('dashboard.users.users', compact('users'));
}

// public function books(Request $request)
// {
//     // $books = Book::paginate(9); // Retrieve all users from the `users` table

//     // return view('dashboard.books.index', compact('books'));
//     $query = Book::query();

//     if ($request->has('search')) {
//         $query->where('title', 'like', '%' . $request->input('search') . '%');
//     }

//     if ($request->has('category')) {
//         $query->where('category_id', $request->input('category'));
//     }

//     $books = $query->paginate(9);
//     // dd($query->toSql());

//     $categories = Category::all(); // Assuming you have a Category model and table

//     return view('dashboard.books.index', compact('books', 'categories'));
// }
public function books(Request $request)
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

    return view('dashboard.books.index', compact('books', 'categories'));
}
}
