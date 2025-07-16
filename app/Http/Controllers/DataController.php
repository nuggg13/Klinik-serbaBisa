<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;

class DataController extends Controller
{
    public function create()
    {
        return view('data.create');
    }

    public function index()
    {
    $data = \App\Models\data::all();
        return view('data.index', compact('data'));
    }

    // Tampilkan form edit
    public function edit($nomor){
        $data = \App\Models\data::findOrFail($nomor);
        return view('data.edit', compact('data'));
    }

    // Simpan hasil update
    public function update(Request $request, $nomor){
        $validated = $request->validate([
        'email' => 'required|email|unique:data,email,' . $nomor . ',nomor',
        'nama' => 'required',
        'umur' => 'required|integer|min:0',
        'kelamin' => 'required|in:L,P',
        'nomor_hp' => 'required|max:20',
        'alamat' => 'required|max:255',        
    ]);

    $data = \App\Models\data::findOrFail($nomor);
    $data->update($validated);

    return redirect()->route('data.index')->with('success', 'Data berhasil diperbarui!');}


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

    public function destroy($nomor){
        $data = \App\Models\data::findOrFail($nomor);
        $data->delete();
        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus!');
    }

}
