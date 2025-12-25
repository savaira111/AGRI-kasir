<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) // ✅ TAMBAH REQUEST DI SINI
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->latest()->get();

        return view('users.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:3',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password, // 👈 TANPA HASH
    ]);

    return redirect()->route('users.index')
        ->with('success', 'User berhasil ditambahkan');
}


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

     public function update(Request $request, User $user)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    if ($request->password) {
        $data['password'] = $request->password; // 👈 TANPA HASH
    }

    $user->update($data);

    return redirect()->route('users.index')
        ->with('success', 'User berhasil diupdate');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
