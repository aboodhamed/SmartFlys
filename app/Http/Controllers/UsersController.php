<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// this Controller for controll with Isers Page in Security pages

class UsersController extends Controller
{
    // index function to show data wanted in Users Page .
    public function index(Request $request)
    {
        $query = User::with('role')
            ->orderByRaw("CASE WHEN display_order IS NULL THEN 1 ELSE 0 END, display_order ASC, id ASC");

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('MobileNumber', 'like', "%{$search}%")
                  ->orWhereHas('role', function ($query) use ($search) {
                      $query->where('RoleName', 'like', "%{$search}%");
                  });
        }

        $users = $query->paginate(10)->appends('search', $search);
        $total =  User::count();
        $showing = $users->count();

        return view('components.Security.users.index', compact('users', 'showing', 'total'));
    }

// edit function
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('components.Security.users.edit', compact('user', 'roles'));
    }

// update function
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'MobileNumber' => 'required|string|max:50',
            'RoleID' => 'nullable|exists:roles,RoleID',
            'display_order' => 'nullable|integer',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'MobileNumber' => $request->MobileNumber,
            'RoleID' => $request->RoleID,
            'display_order' => $request->display_order,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }


// destroy function
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

// changePassword function
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('users.index')->with('success', 'Password changed successfully!');
    }

}