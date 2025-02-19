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

    public function index(Request $request)
    {

        $photos = Photo::with(['Album', 'Like'])->get(); // Eager load Album relationship
        $users = User::with('Photo')->get(); // Eager load Photo relationship
        $comments = Comment::with(['Photo', 'user'])->get();
        $filter = $request->query('filter');

        if ($filter == 'most_like') {
            $photos = Photo::with(['User', 'Like', 'comments'])
                ->withCount('like')
                ->orderByDesc('like_count')
                ->get();
        } elseif ($filter == 'most_comments') {
            $photos = Photo::with(['User', 'Like', 'comments'])
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->get();
        } elseif ($filter == 'latest') {
            $photos = Photo::with(['User', 'Like', 'comments'])
                ->orderByDesc('created_at')
                ->get();
        } else {
            // Ambil foto dalam urutan acak
            $photos = Photo::with(['User', 'Like', 'comments'])
                ->get()
                ;
        }

        return view('index', compact('photos', 'users', 'comments'));
    }
}
