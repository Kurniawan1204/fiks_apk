<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Menggunakan Auth::attempt untuk login
        // Fungsi dari fitur remember me atau "ingat saya" dalam proses login adalah untuk membuat pengguna tetap login di perangkat tertentu, 
        // meskipun mereka menutup browser atau mematikan perangkat. Ini dilakukan dengan menambahkan token ke sesi pengguna yang disimpan
        //  sebagai cookie di browser mereka. Jika remember me diaktifkan, pengguna tidak perlu memasukkan kembali username dan password 
        // setiap kali mengakses aplikasi dari perangkat tersebut, selama periode waktu tertentu atau hingga mereka secara manual logout.
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            // Menyimpan informasi sesi
            $request->session()->regenerate();
            return redirect()->route('home')->with('status', 'Login Berhasil!');
        }

        return redirect()->back()->withErrors(['username' => 'Username atau password salah.']);
    }

    // Berfungsi untuk merestart gambar captcha
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    // menampilkan Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // mem validasi register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'captcha' => ['required','captcha'],
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Registrasi Berhasil! Silakan login.');
    }

    // berfungsi untuk melakukan logout
    public function logout(Request $request)
    {
        Auth::logout();
        // Menghancurkan sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('status', 'Logout Berhasil!');
    }
}
