<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Album;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    // In your Controller
    public function index($slug)
    {
        // Retrieve the album by slug along with its photos
        $album = Album::where('slug', $slug)->with('Photo')->firstOrFail();

        // Check if the album exists
        if (!$album) {
            return redirect()->route('profile')->with('error', 'Album not found.');
        }

        // Check if photos are empty and pass the result to the view
        $photos = $album->photos;

        // Pass the photos and album to the view
        return view('detailPicture', compact('album', 'photos'));
    }


    public function upload(Request $request, $slug)
    {
        $album = Album::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'photo_title' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $photo = new Photo();
        $now = Carbon::now();
        $photo->photo_name = $validated['photo_title'];
        $photo->photo_desc = $validated['desc'];
        $photo->upload_date = $now->format('Y-m-d');
        $photo->user_id = auth()->id();
        $photo->album_id = $album->id;
        $photo->slug = Str::slug($validated['photo_title']);





        // Handle Profile Image Upload
        if ($request->hasFile('photo')) {
            $image_path = $request->file('photo')->store('photos', 'public');
            $photo->image_path = $image_path;
        }

        // Handle Cover Image Upload


        $photo->save();

        return redirect()->route('detail.album', ['slug' => $slug])->with('success', 'Profile updated successfully.');
    }
}
