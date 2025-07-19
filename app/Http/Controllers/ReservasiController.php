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
}
