<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        return redirect()->route('guest.dashboard');
    }

    return view('login'); // Ganti dengan nama view yang sesuai
}


public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        // Return to the login page with validation errors
        return redirect()->route('guest.login')
                         ->withInput()
                         ->withErrors($validator);
    }

    // Check if the email and password are correct
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Authentication passed, redirect to the dashboard
        return redirect()->route('dashboard');
    } else {
        // Authentication failed, return with an error message
        return redirect()->route('guest.login')
                         ->withInput()
                         ->with('error', 'The provided credentials do not match our records.');
    }
}



    public function register(){
        return view('register');

    }
    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255', // Removed unique constraint
            'username' => 'required|string|unique:users|max:255', // Removed 'confirmed'
            'password' => 'required|string|min:8|confirmed', // Corrected rules for password
            'email' => 'required|string|email|max:255|unique:users', // Corrected email validation
        ]);


        if ($validator->fails()) {
            return redirect()
                ->route('guest.register')
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'There are some errors in your input. Please try again.');
        }

        // Simpan data user ke database
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->address = $request->address;
    
        if ($user->save()) {
            return redirect()
                ->route('guest.login')
                ->with('success', 'You have registered successfully. Please log in.');
        } else {
            return redirect()
                ->route('guest.register')
                ->withInput()
                ->with('error', 'Failed to register. Please try again later.');
        }
    }

public function logout()
{
    Auth::logout();
    return redirect()->route('guest.login');
}
}
