<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    $photos = Photo::with('Album')->get(); // Eager load Album relationship
    $users = User::with('Photo')->get(); // Eager load Photo relationship

    // Pass data to the view
    return view('index', compact('photos', 'users'));
}

    
}
