<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function showProfile()
    {
        // Get the authenticated user
        $user = Auth::user();
        $borrowedBooks = $user->borrows()->with('book')->get();

        // Pass the user data to the profile view
        return view('profile', compact('user','borrowedBooks'));
    }


}
