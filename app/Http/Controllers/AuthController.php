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
        $key = 'login|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Anda telah salah memasukan password 3x.'])
                ->with('login_lockout_seconds', RateLimiter::availableIn($key));
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
                ->withErrors(['email' => 'Anda telah salah memasukan password 3x.'])
                ->with('login_lockout_seconds', RateLimiter::availableIn($key));
        }

        return back()->withErrors([
            'email' => "Anda salah memasukan email dan password {$attempts}x.",
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
