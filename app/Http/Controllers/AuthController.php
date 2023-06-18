<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
