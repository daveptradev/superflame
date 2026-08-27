<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{

    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        // 🔥 CEK EMAIL SUDAH ADA
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {

            // kalau email SUDAH ADA tapi BELUM VERIFY
            if (!$existingUser->hasVerifiedEmail()) {

                // kirim ulang email verify
                $existingUser->sendEmailVerificationNotification();

                return back()
                    ->withErrors([
                        'email' => 'Email sudah terdaftar tetapi belum diverifikasi. Link verifikasi baru telah dikirim.'
                    ])
                    ->withInput()
                    ->with('switchToLogin', true);
            }

            // kalau email SUDAH VERIFIED
            return back()
                ->withErrors([
                    'email' => 'Email sudah terdaftar. Silakan login.'
                ])
                ->withInput()
                ->with('switchToLogin', true);
        }

        // 🔥 CREATE USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // 🔥 KIRIM EMAIL VERIFIKASI
        event(new Registered($user));
        
        // 🔥 LOGIN SEMENTARA
        Auth::login($user);

        return redirect('/email/verify');
    }


    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 🔥 CEK EMAIL ADA
        $user = User::where('email', $request->email)->first();

        if (!$user) {

            return back()
                ->with('switchToRegister', true)
                ->withInput()
                ->withErrors([
                    'email' => 'Email tidak terdaftar. Silakan buat akun terlebih dahulu.'
                ]);
        }

        // 🔥 CEK PASSWORD
        if (!Auth::attempt($request->only('email', 'password'))) {

            return back()
                ->withErrors([
                    'password' => 'Password salah'
                ])
                ->withInput()
                ->with('openAuth', true);
        }

        // 🔥 CEK EMAIL VERIFIED
        if (!Auth::user()->hasVerifiedEmail()) {

            Auth::logout();

            return back()
                ->withErrors([
                    'email' => 'Silakan verifikasi email terlebih dahulu.'
                ])
                ->withInput()
                ->with('openAuth', true);
        }

        return redirect('/');
    }


    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
{
    // HAPUS CART DULU
    $request->session()->forget('cart');

    $request->session()->forget('direct_checkout');

    // LOGOUT
    Auth::logout();

    // INVALIDATE
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}