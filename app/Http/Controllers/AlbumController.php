<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index($slug){
        $photo = Photo::where('slug', $slug)
            ->with('id')
            ->firstOrFail();
        return view('detailPicture', compact('photo'));
    }
}
