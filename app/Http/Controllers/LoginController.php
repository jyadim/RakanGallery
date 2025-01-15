<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class loginController extends Controller
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
            'username' => 'required|string',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('guest.login')
                             ->withInput()
                             ->withErrors($validator);
        }
    
        if (Auth::attempt(['RakanEmail' => $request->username, 'RakanPassword' => $request->password])) {
            return redirect()->route('guest.dashboard');
        } else {
            return redirect()->route('guest.login')
                             ->withInput()
                             ->with('error', 'Either username or password is incorrect.');
        }
        
    }
    
    
        public function register(){
            return view('register');
           
        }
    public function processRegister(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
        'email' => 'required|string|max:255',
        'address' => 'required|string|max:255',

    ]);

    if ($validator->fails()) {
        return redirect()->route('register')->withInput()->withErrors($validator);
    }

    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->password = Hash::make($request->password);
    $user->email = $request->email;
    $user->address = $request->address;
    $user->save();

    return redirect()->route('login')->with('success', 'You Have Registered Successfully.');
}
public function logout()
{
    Auth::logout();
    return redirect()->route('guest.login');
}}