<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch necessary data from your database or external APIs
        // $userCount = User::count();
        // $productCount = Product::count();
        // $orderCount = Order::count();

        // Pass the data to the view
        // return view('dashboard.index', compact('userCount', 'productCount', 'orderCount'));
        return view('dashboard.index');

    }

    public function users()
{
    $users = User::all(); // Retrieve all users from the `users` table

    return view('dashboard.users', compact('users'));
}

}
