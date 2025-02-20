<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showPendingUsers()
    {
        // Get all users who have not been verified yet
        $users = User::where('status', 'pending')->get();

        return view('AdminApproval', compact('users'));
    }

    public function approveUser($id)
    {
        // Find the user by ID and approve them
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->status = 'verified';
        $user->save();
        Session::flash('success', 'User Approved Successfully.');
        return redirect()->route('admin.dashboard');
    }

    public function rejectUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input alasan penolakan
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Simpan status dan alasan penolakan
        $user->update([
            'rejected' => true,
            'status' => 'rejected',
            'message' => $request->input('reason'),
        ]);

        // Flash message untuk notifikasi di frontend
        return redirect()->route('admin.dashboard')->with('message', 'User Has Been Rejected Successfully.');
    }



    public function downloadReport()
    {
        // Ambil post dengan like terbanyak
        $mostLikedPosts = Photo::withCount('likes')->orderByDesc('likes_count')->get();

        // Ambil post dengan komentar terbanyak
        $mostCommentedPosts = Photo::withCount('comments')->orderByDesc('comments_count')->get();

        // Data untuk dikirim ke view PDF
        $data = [
            'date' => Carbon::now()->translatedFormat('d F Y'),
            'admin_name' => auth()->user()->name,
            'mostLikedPosts' => $mostLikedPosts,
            'mostCommentedPosts' => $mostCommentedPosts,
        ];

        // Gunakan instance PDF
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf', $data);

        return $pdf->download('POPULAR_POSTS_REPORT.pdf');
    }


}
