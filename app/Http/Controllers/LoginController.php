if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    if (Auth::user()->role === 'owner') {
        return redirect()->route('dashboard.owner')->with('success', 'Login berhasil!');
    } else {
        return redirect()->route('dashboard.kasir')->with('success', 'Login berhasil!');
    }
}
