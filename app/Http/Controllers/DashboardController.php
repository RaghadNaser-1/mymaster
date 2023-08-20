<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
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
        $newUsersPerMonth = User::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) as count'))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->pluck('count', 'month');

    // $months = [];
    // $userCounts = [];

    // foreach ($newUsersPerMonth as $item) {
    //     $months[] = $item->year . '-' . $item->month;
    //     $userCounts[] = $item->count;
    // }
        // Pass the data to the view
        return view('dashboard.index', compact('userCount','bookCount','authorCount','borrowCount','mostBorrowedBook','mostBorrowedUser','borrowsPerMonth','newUsersPerMonth'));

    }

    public function users()
{
    // $users = User::all(); // Retrieve all users from the `users` table
    $users = User::where('role_id', 2)->get();


    return view('dashboard.users.users', compact('users'));
}

public function books()
{
    $books = Book::all(); // Retrieve all users from the `users` table

    return view('dashboard.books.index', compact('books'));
}
}
