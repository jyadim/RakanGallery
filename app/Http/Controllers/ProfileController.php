<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Album;
use Carbon\Carbon;
class ProfileController extends Controller
{
    public function index(){
        $profile = User::get();
        return view('profile', compact('profile'));
    }
    public function edit(){
       
        return view('editprofile');
    }
    public function edit_proccess(Request $request){
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'address' => 'required|string',
                'status' => 'required|string',
                'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('covers', 'public');
                $user->image_cover_path = $coverPath;
            }
        
            $user->save();
        
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        
        public function create_album(Request $request){
            $validated = $request->validate([
                'album_title' => 'required|string|max:255',
                'desc' => 'required|string|max:255',
                
            ]);
        
            $album = new Album();
            $now = Carbon::now(); 
            $album->album_name = $validated['album_title'];
            $album->desc = $validated['desc'];
            $album->upload_date = $now->format('Y-m-d');
            $album->id = auth()->id();
       
        
            // Handle Profile Image Upload
        
            $album->save();
        
            return redirect()->route('profile')->with('success', 'Album created successfully.');
        }
        }
        
    
