<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fungsi untuk menampilkan semua notifikasi user yang login
    public function index()
    {
        $notifications = Notification::where('notifiable_type', User::class)
        ->where('notifiable_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
    

        return response()->json($notifications);
    }

    // Fungsi untuk menandai notifikasi sebagai telah dibaca
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)->where('user_id', Auth::id())->first();
        
        if ($notification) {
            $notification->update(['is_read' => true]);
        }

        return response()->json(['message' => 'Notification marked as read']);
    }

    // Fungsi untuk membuat notifikasi baru (dipanggil saat like/comment)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',  // User yang akan menerima notifikasi
            'type' => 'required|in:comment,like',
            'message' => 'required|string',
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'notifier_id' => Auth::id(),
            'type' => $request->type,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Notification created successfully']);
    }
}

