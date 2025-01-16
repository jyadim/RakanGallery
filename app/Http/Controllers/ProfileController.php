<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function index(){
        $profile = User::get();
        return view('profile', compact('profile'));
    }
    public function edit(){
       
        return view('editprofile');
    }
    public function edit_proccess(){
       
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'address' => 'required|string',
                'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);
        
            $user = auth()->user();
            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->sex = $validated['sex'];
            $user->dob = $validated['dob'];
        
            // Handle Profile Image Upload
            if ($request->hasFile('profile')) {
                $profilePath = $request->file('profile')->store('profiles', 'public');
                $user->profile_image = $profilePath;
            }
        
            // Handle Cover Image Upload
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('covers', 'public');
                $user->cover_image = $coverPath;
            }
        
            $user->save();
        
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        
        
    }
