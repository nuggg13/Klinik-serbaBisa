<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;
use App\Models\Jadwal;
use App\Models\Reservasi;

class DataController extends Controller
{
    // Tampilkan form tambah data
    public function create()
    {
        return view('data.create');
    }

    // Tampilkan semua data
    public function index()
    {
        $data = data::all();
        return view('data.index', compact('data'));
    }

    // Tampilkan form edit data
    public function edit($nomor)
    {
        $data = data::findOrFail($nomor);
        return view('data.edit', compact('data'));
    }

    // Simpan hasil update
    public function update(Request $request, $nomor)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:data,email,' . $nomor . ',nomor',
            'nama' => 'required',
            'umur' => 'required|integer|min:0',
            'kelamin' => 'required|in:L,P',
            'nomor_hp' => 'required|max:20',
            'alamat' => 'required|max:255',
        ]);

        $data = data::findOrFail($nomor);
        $data->update($validated);

        return redirect()->route('data.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:data,email',
            'nama' => 'required',
            'umur' => 'required|integer|min:0',
            'kelamin' => 'required|in:L,P',
            'nomor_hp' => 'required|max:20',
            'alamat' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        data::create($validated);

        return redirect()->route('data.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Hapus data
    public function destroy($nomor)
    {
        $data = data::findOrFail($nomor);
        $data->delete();
        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus!');
    }

    // Tampilkan dashboard pasien
    public function dashboardPasien()
{
    $jadwal = \App\Models\Jadwal::all();

    // Ambil email dari session
    $email = session('user_email');

    // Ambil reservasi milik user yang login saja
    $history = \App\Models\Reservasi::with('jadwal')
                ->where('email', $email)
                ->latest()
                ->get();

    return view('dashboard-pasien', compact('jadwal', 'history'));
}

public function dashboardAdmin()
{
    $reservasi = Reservasi::with('jadwal')->latest()->get();
    return view('dashboard-admin', compact('reservasi'));
}
}