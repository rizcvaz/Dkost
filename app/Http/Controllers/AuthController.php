<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // default role
        ]);
        return redirect('/')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return redirect('/admin/dashboard')->with('success', 'Login berhasil, selamat datang Admin!');
        } elseif ($user && $user->role === 'user') {
            return redirect('/user/dashboard');
        } else {
            Auth::logout();
            return redirect('/')->withErrors(['role' => 'Unauthorized role']);
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('logout', true);

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}

