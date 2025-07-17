<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal dari database
        $jadwal = Jadwal::all();

        // Kirim data ke view 'home.blade.php'
        return view('home', compact('jadwal'));
    }
}
