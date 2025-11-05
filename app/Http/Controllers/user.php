<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua data user
    public function index()
    {
        $users = User::all(); // ngambil semua data dari tabel users
        return view('user.index', compact('users'));
    }

    // Menampilkan form tambah user baru
    public function create()
    {
        return view('user.create');
    }

    // Nyimpen data user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // password di-hash biar aman
        ]);

        return redirect()->route('user.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Update data user yang udah ada
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diupdate!');
    }

    // Hapus user dari database
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
