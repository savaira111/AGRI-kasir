<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //menampilkan halaman login//
    public function showLogin()
    {
        return view('auth.login');
    }

    //mengisi data login//
    public function login(Request $request)
    {
           // validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password,
        ];
        // mengecek apakah data login sesuai dengan database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // mengganti sesion id yang lama agar mencegah sesion hack
            return redirect('/dashboard')->with('success', 'Berhasil login!'); // jika berhasil akan masuk ke halaman dashboard
        }

        // dd($request);
// apabila login salah akan tetap dihalaman tersebut 
        return back()->withErrors([
            'login' => 'Username atau password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // keluar dari akun
        $request->session()->invalidate(); // menghapus sesion user
        $request->session()->regenerateToken(); // mengganti sesion id yang lama agar mencegah sesion hack
  // url setelah logout akan balik lagi kehalaman login
        return redirect()->route('login');
    }
}
