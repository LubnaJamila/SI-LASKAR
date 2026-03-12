<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Email atau password salah');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS AKUN
        |--------------------------------------------------------------------------
        */
        if ($user->status === 'non-aktif') {
            Auth::logout();
            return back()->with('error', 'Akun tidak aktif');
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'petugas') {

            // belum join team
            if (!$user->isPartOfAnyTeam()) {
        dd([
            'ketuaTeams' => $user->ketuaTeams()->get(),
            'memberTeams' => $user->teams()->get(),
        ]);
        return redirect()->route('belum.team');
    }

    return redirect()->route('petugas.hotspot');
        }

        return redirect('/');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}