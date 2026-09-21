<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(LoginRequest $request)
    {
        $key = 'login|' . strtolower($request->email) . '|' . $request->ip();
        $lockoutSeconds = RateLimiter::availableIn($key);

        if ($lockoutSeconds > 0) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Terlalu banyak percobaan login. Silakan tunggu timer selesai.'])
                ->with('login_lockout_seconds', $lockoutSeconds);
        }

        if (Auth::attempt($request->validated())) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Selamat datang,' . Auth::user()->name . '!');
        }

        RateLimiter::hit($key, 60);
        $attempts = RateLimiter::attempts($key);

        if ($attempts >= 3) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => '3 percobaan login gagal. Silakan tunggu 60 detik sebelum mencoba lagi.'])
                ->with('login_lockout_seconds', RateLimiter::availableIn($key));
        }

        return back()->withErrors([
            'email' => "Email atau password tidak valid. Percobaan gagal {$attempts} dari 3.",
        ]);
    }
    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
