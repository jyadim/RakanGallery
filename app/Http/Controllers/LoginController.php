<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('guest.login')
                ->withInput()
                ->withErrors($validator);
        }

        // Cek kredensial terlebih dahulu
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Cek apakah pengguna belum terverifikasi
            if (!$user->verified) {
                Auth::logout();
                return redirect()->route('guest.login')->with('error', 'Your Account Has not Being Verified.');
            }

            // Cek apakah pengguna adalah admin
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // Jika bukan admin, arahkan ke dashboard biasa
            return redirect()->route('dashboard');
        }

        // Jika autentikasi gagal, kembalikan ke login dengan pesan error
        return redirect()->route('guest.login')
            ->withInput()
            ->with('error', 'Email or Password is Incorrect.');
    }



    public function register()
    {
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
                ->with('error', 'You have registered successfully. Please kindly wait until verified.');
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

        return redirect()->route('guest.login')->with('error', 'Your Account Has Been Logout Successfully.');
    }
}
