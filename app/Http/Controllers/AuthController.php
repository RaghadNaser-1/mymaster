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
            $request->session()->put('user_id', $user->id);

            // Store welcome message in session
            $request->session()->put('welcome_message', "Welcome, {$user->name}!");


            if ($user->role_id == 2) {
                // Redirect to '/index' for role ID 2
                return redirect('/');
            } elseif ($user->role_id == 1) {
                // Redirect to '/dashboard' for role ID 1
                return redirect('/dashboard');
            }
        } else {


            return back()->withErrors([
                'email' => 'The provided credentials is not correct.',
            ]);

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
    return redirect('/')->with('success', 'You have been logged out successfully.');
}


}
