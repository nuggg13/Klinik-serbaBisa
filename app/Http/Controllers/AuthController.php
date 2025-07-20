<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = data::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput();
        }

        // Cek password (asumsi masih plaintext)
        if ($credentials['password'] !== $user->password) {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }

        // Simpan data login ke session
        session([
    'user_id'       => $user->nomor,
    'user_nama'     => $user->nama,
    'user_email'    => $user->email,
    'user_umur'     => $user->umur,
    'user_kelamin'  => $user->kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
    'user_nomor_hp' => $user->nomor_hp,
    'user_alamat'   => $user->alamat,
]);


        return redirect()->route('dashboard.pasien');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // Hapus semua session
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
