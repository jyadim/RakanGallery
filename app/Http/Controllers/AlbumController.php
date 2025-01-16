<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
   // In your Controller
   public function index($slug)
   {
       // Retrieve the album by slug
       $album = Album::where('slug', $slug)->firstOrFail();
   
       // Check if the album exists
       if (!$album) {
           return redirect()->route('profile')->with('error', 'Album not found.');
       }
   
       // Retrieve all photos associated with the album
       $photos = $album->photo;  // This uses the 'photos' relationship defined earlier
       

       // If there are no photos, show a message
       if ($photos->isEmpty()) {
           return view('detailPicture', compact('album'))->with('message', 'No photos found for this album.');
       }
   
       // Pass the photos and album to the view
       return view('detailPicture', compact('photos', 'album'));
   }
   

}
