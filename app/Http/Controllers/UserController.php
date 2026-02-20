<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserStatusUpdated;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,active,rejected,banned']);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        // Send email notification
        Mail::to($user->email)->send(new UserStatusUpdated($user));

        return redirect()->back()->with('success', 'User status updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}