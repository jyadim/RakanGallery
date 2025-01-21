<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Photo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function show($slug)
    {
        // Ambil foto berdasarkan slug
        $photo = Photo::where('slug', $slug)->with('Album')->firstOrFail();

        // Ambil komentar terkait foto dan reply secara hierarki berdasarkan parent_id
        $comments = Comment::with(['user', 'replies' => function ($query) {
            $query->with('user')->orderBy('created_at', 'asc');
        }])
            ->where('photo_id', $photo->id)
            ->whereNull('parent_id') // Ambil hanya komentar utama
            ->orderBy('created_at', 'asc')
            ->get();

        return view('detPhoto', compact('photo', 'comments'));
    }


    public function store_comments(Request $request)
    {

        $request->validate([
            'comments' => 'required|string|max:255',
            'photo_id' => 'required|integer|exists:photos,id',
            'parent_id' => 'nullable|integer',
        ]);
        $now = Carbon::now();
        $comm = new Comment();

        $comm->comments = $request->comments;
        $comm->upload_date = $now->format('Y-m-d');
        $comm->photo_id = $request->photo_id;
        $comm->parent_id = $request->parent_id;
        $comm->user_id = auth()->id();

        $comm->save();
        return redirect()->route('dashboard')->with('success', 'Comments added successfully.');
    }


    public function like($id)
    {
        $photo = Photo::findOrFail($id);
        $user = Auth::user();
$now = Carbon::now();
        // Cek apakah user sudah memberikan like
        $existingLike = Like::where('photo_id', $photo->id)->where('user_id', $user->id)->first();

        if ($existingLike) {
            // Jika sudah like, hapus (unlike)
            $existingLike->delete();
            $message = 'You have unliked the photo.';
        } else {
            // Jika belum like, tambahkan like
            Like::create([
                'photo_id' => $photo->id,
                'user_id' => $user->id,
                'like_date' => $now->format('Y-m-d')
            ]);
            $message = 'You have liked the photo.';
        }

        return redirect()->back()->with('success', $message);
    }
}
