<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Album;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profile = User::where('id', auth()->id())->get(); // Hanya ambil data user login

        $album = Album::with(['User', 'Photo']) // Notice the plural `photos`
            ->where('user_id', auth()->id())
            ->latest() // Orders albums by the most recent first
            ->get();
        $filter = $request->query('filter');

        if ($filter == 'most_like') {
            $photos = Photo::with(['User', 'Like', 'comments'])
                ->withCount('like')
                ->orderByDesc('like_count')
                ->take(3) // Ambil 3 besar
                ->get();
        } elseif ($filter == 'most_comments') {
            $photos = Photo::with(['User', 'Like', 'comments'])
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->take(3) // Ambil 3 besar
                ->get();
        }
        // Pass the profile and albums to the view
        return view('profile', compact('profile', 'album', 'photos'));
    }
    public function edit()
    {

        return view('editprofile');
    }
    public function edit_proccess(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|string',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $user = auth()->user();
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->address = $validated['address'];
        $user->status = $validated['status'];

        // Handle Profile Image Upload
        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $user->image_path = $profilePath;
        }

        // Handle Cover Image Upload


        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function create_album(Request $request)
    {
        $validated = $request->validate([
            'album_title' => 'required|string|max:255',
            'desc' => 'required|string|max:255',

        ]);

        $album = new Album();
        $now = Carbon::now();
        $album->album_name = $validated['album_title'];
        $album->desc = $validated['desc'];
        $album->upload_date = $now->format('Y-m-d');
        $album->user_id = auth()->id();
        $album->slug = Str::slug($validated['album_title']);


        // Handle Profile Image Upload

        $album->save();

        return redirect()->route('profile')->with('success', 'Album created successfully.');
    }


}
