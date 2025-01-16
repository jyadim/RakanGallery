<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function index(){
        $profile = User::get();
        return view('profile', compact('profile'));
    }
    public function edit(){
       
        return view('editprofile');
    }
    public function edit_proccess(){
       
        
    }
}
