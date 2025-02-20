<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Album;
use App\Models\Comment;
use App\Models\Like;
use Barryvdh\DomPDF\Facade\Pdf;
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

        // Ambil semua photo_id dalam album ini
        $photoIds = $album->Photo->pluck('id');

        // Ambil data like berdasarkan photo_id dalam album
        $likes = Like::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereIn('photo_id', $photoIds)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        // Ambil data komentar berdasarkan photo_id dalam album
        $comments = Comment::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereIn('photo_id', $photoIds)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        // Konversi ke format yang sesuai untuk chart
        $dates = $likes->keys()->merge($comments->keys())->unique()->sort()->values();

        $likeData = $dates->map(fn($date) => $likes[$date] ?? 0)->toArray();
        $commentData = $dates->map(fn($date) => $comments[$date] ?? 0)->toArray();

        // Ambil foto dalam album (paginate 4 per halaman)
        $photos = $album->Photo()->paginate(4);

        // Kirim data ke view
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



    
    public function downloadReport($slug, Request $request)
    {
        // Ambil album berdasarkan slug
        $album = Album::where('slug', $slug)->with('Photo')->firstOrFail();
        
        // Ambil semua photo_id dalam album
        $photoIds = $album->Photo->pluck('id');
    
        // Filter berdasarkan like atau comment (jika ada)
        $filter = $request->get('filter'); // 'likes' atau 'comments'
    
        if ($filter == 'likes') {
            $photos = Photo::whereIn('id', $photoIds)
                ->withCount('likes')
                ->orderByDesc('likes_count')
                ->get();
        } elseif ($filter == 'comments') {
            $photos = Photo::whereIn('id', $photoIds)
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->get();
        } else {
            // Default, ambil semua foto tanpa filter
            $photos = Photo::whereIn('id', $photoIds)->get();
        }
    
        // Data untuk dikirim ke PDF
        $data = [
            'date' => Carbon::now()->translatedFormat('d F Y'),
            'admin_name' => auth()->user()->name,
            'album' => $album,
            'photos' => $photos,
            'filter' => $filter
        ];
    
        // Buat PDF
        $pdf = Pdf::loadView('pdf.album_report', $data);
    
        return $pdf->download('Album_Report.pdf');
    }
    
}
