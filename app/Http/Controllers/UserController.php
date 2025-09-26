<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // function to show user profile page as index
    public function index()
    {
        return view('components.User.index');
    }

    // function to update user profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'MobileNumber' => 'required|string|max:50',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->MobileNumber = $request->MobileNumber;
        $user->save(); // Corrected: save()

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // function to change user password
    public function changePassword(Request $request)
    {
        $user = Auth::user(); // Corrected: Auth::user()

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save(); // Corrected: save()

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    // function to delete user account
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password is incorrect.');
        }

        $user->delete(); // Corrected: delete()

        return redirect('/login')->with('success', 'Account deleted successfully!');
    }
    
}