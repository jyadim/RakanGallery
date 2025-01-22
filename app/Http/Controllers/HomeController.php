<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index()
{

    $photos = Photo::with(['Album', 'Like'])->get(); // Eager load Album relationship
    $users = User::with('Photo')->get(); // Eager load Photo relationship
    $comments = Comment::with(['Photo', 'user'])->get();

    return view('index', compact('photos', 'users', 'comments'));
}



}
