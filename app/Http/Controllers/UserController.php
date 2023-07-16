<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Borrow;


use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function showProfile()
    // {
    //     // Get the authenticated user
    //     $user = Auth::user();
    //     $borrowedBooks = $user->borrows()->with('book')->get();

    //     // Pass the user data to the profile view
    //     return view('profile', compact('user','borrowedBooks'));
    // }
    public function showProfile()
{
    // Get the authenticated user
    $user = auth()->user();

     // Retrieve the borrowed books for the user that have not been returned
     $borrowedBooks = $user->borrows()
     ->where('returned', false)
     ->with('book')
     ->get();
     $favoriteBooks = $user->favorites;
     $borrows = $user->borrows()->orderByDesc('borrowed_at')->get();

    // Pass the user data and borrowed books to the profile view
    return view('profile', compact('user', 'borrowedBooks','favoriteBooks','borrows'));
}


    public function create()
    {
        // Show the form to create a new user
        return view('dashboard.users.create');
    }

    public function edit(User $user)
    {
        // Show the form to edit an existing user
        return view('dashboard.users.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Optionally, you can return a response or redirect to a different page
        return redirect()->route('userstable')->with('success', 'User deleted successfully');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Optionally, you can return a response or redirect to a different page
        return redirect()->route('userstable')->with('success', 'User created successfully');
    }

    public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
    ]);

    // Optionally, you can return a response or redirect to a different page
    return redirect()->route('userstable')->with('success', 'User updated successfully');
}

}
