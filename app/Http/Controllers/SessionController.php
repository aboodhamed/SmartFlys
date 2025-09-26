<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    // create function
    public function create()
    {
        return view('auth.login');
    }

    // store function
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد غير صحيحة.',
        ])->onlyInput('email');
    }

    // destroy function
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'تم تسجيل الخروج بنجاح!');
    }
}