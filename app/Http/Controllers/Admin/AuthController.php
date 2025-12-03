<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'Admin.pages.auth.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Kata Sandi wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if (!$user) {
            return back()
            ->withErrors(['username' => 'Akun anda belum terdaftar'])
           ->onlyInput('username'); 
        }

        if (Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()
            ->withErrors(['password' => 'Password anda salah, tolong beriksa kembali password anda.'])
            ->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
