<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;
use App\Models\Reservasi;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal dari database
        $jadwal = Jadwal::all();

        // Kirim data ke view 'home.blade.php'
        return view('home', compact('jadwal'));
        return view('dashboard-pasien', compact('jadwal'));
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
