<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        Session::flash('success', 'User Approved Successfully.');
        return redirect()->route('admin.dashboard');
    }

    public function rejectUser($id)
    {
        // Find the user by ID and delete them if rejected
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('error', 'User Has Being Rejected and Deleted Successfully.');

        return redirect()->route('admin.dashboard')->with('message', 'User rejected and deleted.');
    }
}
