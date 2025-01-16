<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index($slug)
{
    // Log or debug the incoming slug
    \Log::info("Slug received: " . $slug);

    $photo = Photo::where('slug', $slug)->get();

    // Log or debug the photo data
    \Log::info($photo);

    return view('detailPicture', compact('photo'));
}

}
