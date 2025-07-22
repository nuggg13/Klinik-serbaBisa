<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Jadwal;

class ReservasiController extends Controller
{
    public function create()
    {
        $jadwal = Jadwal::all();
        return view('reservasi.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'schedule_id' => 'required|exists:jadwal,schedule_id',
            'keluhan' => 'required|string',
        ]);

        Reservasi::create($request->all());

        return redirect()->back()->with('success', 'Reservasi berhasil dibuat!');
    }

    public function dashboardPasien()
    {
        $email = session('user_email');
        // Total kunjungan
        $totalKunjungan = Reservasi::where('email', $email)->count();

        // Reservasi aktif (jika ada field status, misal status='aktif')
        // $reservasiAktif = Reservasi::where('email', $email)->where('status', 'aktif')->count();
        // Jika tidak ada status, bisa diisi 0 atau count reservasi hari ini
        $reservasiAktif = Reservasi::where('email', $email)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // Riwayat reservasi terakhir
        $riwayatTerakhir = Reservasi::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Layanan tersedia (group by poli)
        $layanan = Jadwal::select('poli')
            ->groupBy('poli')
            ->get();

        // Data jadwal untuk section lain
        $jadwal = Jadwal::all();

        // History untuk section history
        $history = Reservasi::where('email', $email)->with('jadwal')->orderBy('created_at', 'desc')->get();

        return view('dashboard-pasien', compact(
            'totalKunjungan',
            'reservasiAktif',
            'riwayatTerakhir',
            'layanan',
            'jadwal',
            'history'
        ));
    }
}
