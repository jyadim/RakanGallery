<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showPendingUsers()
    {
        // Get all users who have not been verified yet
        $users = User::where('verified', false)->get();

        return view('AdminApproval', compact('users'));
    }

    public function approveUser($id)
    {
        // Find the user by ID and approve them
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', 'User approved successfully.');
    }

    public function rejectUser($id)
    {
        // Find the user by ID and delete them if rejected
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('message', 'User rejected and deleted.');
    }
}
