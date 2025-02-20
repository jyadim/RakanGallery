<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Photo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function show($slug)
    {
        $photo = Photo::where('slug', $slug)->with('album')->firstOrFail();

        // Ambil komentar terkait dengan hierarki parent-child
        $comments = Comment::with(['user', 'replies.user'])
            ->where('photo_id', $photo->id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('detPhoto', compact('photo', 'comments'));
    }

    public function store_comments(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('guest.login')->with('error', 'You must log in to comment.');
        } else {
            # code...


            $request->validate([
                'comments' => 'required|string|max:255',
                'photo_id' => 'required|integer|exists:photos,id',
                'parent_id' => 'nullable|integer|exists:comments,id',
            ]);

            $comment = Comment::create([
                'comments' => $request->comments,
                'upload_date' => Carbon::now()->format('Y-m-d'),
                'photo_id' => $request->photo_id,
                'parent_id' => $request->parent_id,
                'user_id' => auth()->id(),
            ]);

            // Check if the photo exists before accessing its owner
            if ($comment->photo) {
                $photoOwner = $comment->photo->user;
                $currentUser = Auth::user();

                if ($photoOwner && $photoOwner->id !== Auth::id()) {
                    Notification::create([
                        'notifiable_type' => User::class,
                        'notifiable_id' => $photoOwner->id,
                        'type' => 'comment',
                        'data' => json_encode([
                            'message' => "{$currentUser->username} Commented on Your Photo",
                            'username' => $currentUser->username,
                        ]),
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Comment added successfully.');
        }
    }

    public function like($id)
    {
        if (!Auth::check()) {
            return redirect()->route('guest.login')->with('error', 'You must log in to like a photo.');
        } else {
            # code...

            $photo = Photo::findOrFail($id);
            $user = Auth::user();


            // Cek apakah user sudah memberikan like sebelumnya
            $existingLike = Like::where('photo_id', $photo->id)->where('user_id', $user->id)->first();

            if ($existingLike) {
                // Jika sudah like, maka unlike
                $existingLike->delete();
                $message = 'You have unliked the photo.';
            } else {
                // Jika belum like, tambahkan like
                Like::create([
                    'photo_id' => $photo->id,
                    'user_id' => $user->id,
                    'like_date' => Carbon::now()->format('Y-m-d'),
                ]);
                $currentUser = Auth::user();

                // Kirim notifikasi ke pemilik foto
                $photoOwner = $photo->user;
                if ($photoOwner->id !== Auth::id()) {
                    Notification::create([
                        'notifiable_type' => User::class,  // Model yang menerima notifikasi
                        'notifiable_id' => $photoOwner->id, // ID pengguna yang menerima notifikasi
                        'type' => 'like',
                        'data' => json_encode([
                            'message' => "{$currentUser->username} Liked Your Photo",
                            'username' => $currentUser->username,
                        ]),
                    ]);
                }

                $message = 'You have liked the photo.';
            }

            return redirect()->back()->with('success', $message);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo_title' => 'required|string|max:255',
            'desc' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo = Photo::findOrFail($id);
        $photo->photo_name = $request->photo_title;
        $photo->photo_desc = $request->desc;

        $photo->save();

        return redirect()->back()->with('success', 'Photo updated successfully.');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Hapus file foto dari storage
        Storage::delete('public/' . $photo->image_path);

        $photo->delete();

        return redirect()->back()->with('error', 'Photo Deleted Successfully.');
    }
}
