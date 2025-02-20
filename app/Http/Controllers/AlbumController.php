<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Album;
use App\Models\Comment;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $photos = $album->Photo()->paginate(4);
        $likes = Like::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereNotNull('photo_id') // Sesuaikan dengan kolom yang menyimpan like
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        $comments = Comment::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereNotNull('photo_id') // Sesuaikan dengan kolom yang menyimpan komentar
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        // Konversi ke format yang sesuai untuk chart
        $dates = $likes->keys()->merge($comments->keys())->unique()->sort()->values();

        $likeData = $dates->map(fn($date) => $likes[$date] ?? 0)->toArray();
        $commentData = $dates->map(fn($date) => $comments[$date] ?? 0)->toArray();
        // Pass the photos and album to the view
        return view('detailPicture', compact('album', 'photos', 'likeData', 'commentData', 'dates'));
    }


    public function upload(Request $request, $slug)
    {
        $album = Album::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'photo_title' => 'nullable|string|max:255',
            'desc' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif',
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
        Session::flash('success', 'Photo Uploaded Successfully.');

        return redirect()->route('detail.album', ['slug' => $slug]);
    }
    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        $album = Album::findOrFail($id);
        $album->album_name = $request->album_name;
        $album->desc = $request->desc;
        $album->save();
        Session::flash('success', 'Album Updated Successfully.');

        return redirect()->route('profile');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        // Check if album has photos, and if it does, delete them
        if ($album->Photo->isNotEmpty()) {
            foreach ($album->Photo as $photo) {
                Storage::delete('public/' . $photo->image_path);
                $photo->delete();
            }
        }

        // Delete the album
        $album->delete();

        return redirect()->route('profile')->with('error', 'Album Deleted Successfully.');
    }

    public function chart()
    {
        // Ambil data dari database (sesuaikan dengan model dan struktur tabel)


        return view('detailPicture', compact('dates', 'likeData', 'commentData'));
    }
}
