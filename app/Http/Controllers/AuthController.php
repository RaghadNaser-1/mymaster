<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'repeat' => 'required|same:password',

        ]);

        // Create a new signup record
        $signup = new User();
        $signup->name = $request->input('name');
        $signup->email = $request->input('email');
        $signup->password = bcrypt($request->input('password'));
        $signup->save();

        // Set success flash message
        // $request->session()->flash('success', 'Signup process completed successfully!');

        // Redirect to a success page or route
        // return redirect('/index')->with('success', 'Signup process completed successfully!');
        return redirect()->back()->with('success', 'Signup process completed successfully!');

    }

    public function login(Request $request)
    {
        // Perform authentication

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Authentication successful

            $user = Auth::user();

            // Store welcome message in session
            // $request->session()->flash('success', 'Welcome, ' . $user->name . '!');
            $request->session()->put('welcome_message', "Welcome, {$user->name}!");


            // Redirect to the desired page
            return redirect('/index');
        } else {
            // Authentication failed

            // Store error message in session
            // $request->session()->flash('error', 'Invalid credentials.');
            // $request->session()->put('error', "Invalid credentials.");

            return back()->withErrors([
                'email' => 'The provided credentials is not correct.',
            ]);
            // Redirect back to the login page
            // return redirect('/login');
        }
    }

    public function logout(Request $request)
{
    // Clear session data
    $request->session()->flush();

    // Regenerate session ID and delete the old session
    $request->session()->regenerate(true);

    // Clear the authentication state
    Auth::logout();

    // Redirect the user to the desired page after logout
    return redirect('/index')->with('success', 'You have been logged out successfully.');
}


}
