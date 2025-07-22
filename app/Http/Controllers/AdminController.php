<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = DB::table('admin')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($admin) {
            session([
                'admin_id' => $admin->nomor,
                'admin_nama' => $admin->nama_admin,
                'admin_email' => $admin->email,
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau Password salah.');
    }

        public function dashboard()
{
    // Ambil data pasien dari tabel "data"
    $dataPasien = DB::table('data')
        ->select('nomor', 'email', 'nama', 'umur', 'kelamin', 'nomor_hp', 'alamat')
        ->get();

    // Ambil data admin dari tabel "admin"
    $dataAdmin = DB::table('admin')
        ->select('nomor', 'nama_admin', 'email')
        ->get();

    // TAMBAHKAN INI - Ambil data jadwal dokter
    $dataJadwal = DB::table('jadwal')
        ->select('schedule_id', 'nama', 'poli', 'hari', 'waktu', 'maximal_reservasi')
        ->get();

    return view('admin.dashboard', compact('dataPasien', 'dataAdmin', 'dataJadwal'));
}

    public function logout()
    {
        session()->forget(['admin_id', 'admin_nama', 'admin_email']);
        return redirect()->route('admin.login');
    }

    // ========== PASIEN CRUD METHODS ==========
    public function storePasien(Request $request)
    {
        // Debug: Lihat semua data yang dikirim
        // dd($request->all());
        
        // Validasi input
        $validatedData = $request->validate([
            'email' => 'required|email|unique:data,email',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'kelamin' => 'required|in:L,P',
            'nomor_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        try {
            // Insert data ke tabel "data"
            $inserted = DB::table('data')->insert([
                'email' => $validatedData['email'],
                'nama' => $validatedData['nama'],
                'umur' => $validatedData['umur'],
                'kelamin' => $validatedData['kelamin'],
                'nomor_hp' => $validatedData['nomor_hp'],
                'alamat' => $validatedData['alamat'],
                'password' => $validatedData['password'], // Note: Sebaiknya di-hash
            ]);

            if ($inserted) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Data pasien berhasil ditambahkan!');
            } else {
                return redirect()->back()
                    ->with('error', 'Gagal menyimpan data pasien.')
                    ->withInput();
            }

        } catch (\Exception $e) {
            // Debug: Lihat error yang sebenarnya
            // dd($e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deletePasien($id)
    {
        try {
            // Cek apakah data pasien ada
            $pasien = DB::table('data')->where('nomor', $id)->first();
            
            if (!$pasien) {
                return redirect()->back()
                    ->with('error', 'Data pasien tidak ditemukan.');
            }

            // Hapus data pasien
            $deleted = DB::table('data')->where('nomor', $id)->delete();

            if ($deleted) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Data pasien berhasil dihapus!');
            } else {
                return redirect()->back()
                    ->with('error', 'Gagal menghapus data pasien.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function editPasien($id)
    {
        try {
            // Ambil data pasien berdasarkan ID
            $pasien = DB::table('data')->where('nomor', $id)->first();
            
            if (!$pasien) {
                return redirect()->back()
                    ->with('error', 'Data pasien tidak ditemukan.');
            }

            // Return JSON response untuk AJAX
            return response()->json([
                'success' => true,
                'data' => $pasien
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function updatePasien(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'email' => 'required|email|unique:data,email,' . $id . ',nomor',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'kelamin' => 'required|in:L,P',
            'nomor_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'password' => 'nullable|string|min:6', // Password optional saat edit
        ]);

        try {
            // Cek apakah data pasien ada
            $pasien = DB::table('data')->where('nomor', $id)->first();
            
            if (!$pasien) {
                return redirect()->back()
                    ->with('error', 'Data pasien tidak ditemukan.');
            }

            // Prepare data untuk update
            $updateData = [
                'email' => $validatedData['email'],
                'nama' => $validatedData['nama'],
                'umur' => $validatedData['umur'],
                'kelamin' => $validatedData['kelamin'],
                'nomor_hp' => $validatedData['nomor_hp'],
                'alamat' => $validatedData['alamat'],
            ];

            // Jika password diisi, update juga
            if (!empty($validatedData['password'])) {
                $updateData['password'] = $validatedData['password'];
            }

            // Update data pasien
            $updated = DB::table('data')
                ->where('nomor', $id)
                ->update($updateData);

            if ($updated) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Data pasien berhasil diupdate!');
            } else {
                return redirect()->back()
                    ->with('error', 'Tidak ada perubahan data atau gagal mengupdate.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ========== ADMIN CRUD METHODS ==========
    public function storeAdmin(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            // Insert data ke tabel "admin"
            $inserted = DB::table('admin')->insert([
                'nama_admin' => $validatedData['nama_admin'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'], // Note: Sebaiknya di-hash untuk keamanan
            ]);

            if ($inserted) {
                return redirect()->route('admin.dashboard')
                    ->with('success_admin', 'Admin baru berhasil ditambahkan!');
            } else {
                return redirect()->back()
                    ->with('error_admin', 'Gagal menyimpan data admin.')
                    ->withInput();
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error_admin', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editAdmin($id)
    {
        try {
            // Ambil data admin berdasarkan ID
            $admin = DB::table('admin')->where('nomor', $id)->first();
            
            if (!$admin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data admin tidak ditemukan.'
                ]);
            }

            // Return JSON response untuk AJAX (tanpa password untuk keamanan)
            return response()->json([
                'success' => true,
                'data' => [
                    'nomor' => $admin->nomor,
                    'nama_admin' => $admin->nama_admin,
                    'email' => $admin->email
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function updateAdmin(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email,' . $id . ',nomor',
            'password' => 'nullable|string|min:6|confirmed', // Password optional saat edit
        ]);

        try {
            // Cek apakah data admin ada
            $admin = DB::table('admin')->where('nomor', $id)->first();
            
            if (!$admin) {
                return redirect()->back()
                    ->with('error_admin', 'Data admin tidak ditemukan.');
            }

            // Prepare data untuk update
            $updateData = [
                'nama_admin' => $validatedData['nama_admin'],
                'email' => $validatedData['email'],
            ];

            // Jika password diisi, update juga
            if (!empty($validatedData['password'])) {
                $updateData['password'] = $validatedData['password'];
            }

            // Update data admin
            $updated = DB::table('admin')
                ->where('nomor', $id)
                ->update($updateData);

            if ($updated) {
                return redirect()->route('admin.dashboard')
                    ->with('success_admin', 'Data admin berhasil diupdate!');
            } else {
                return redirect()->back()
                    ->with('error_admin', 'Tidak ada perubahan data atau gagal mengupdate.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error_admin', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyAdmin($id)
    {
        try {
            // Cek apakah data admin ada
            $admin = DB::table('admin')->where('nomor', $id)->first();
            
            if (!$admin) {
                return redirect()->back()
                    ->with('error_admin', 'Data admin tidak ditemukan.');
            }

            // Cek jangan sampai menghapus admin yang sedang login
            if (session('admin_id') == $id) {
                return redirect()->back()
                    ->with('error_admin', 'Tidak bisa menghapus akun admin yang sedang digunakan.');
            }

            // Hapus data admin
            $deleted = DB::table('admin')->where('nomor', $id)->delete();

            if ($deleted) {
                return redirect()->route('admin.dashboard')
                    ->with('success_admin', 'Admin berhasil dihapus!');
            } else {
                return redirect()->back()
                    ->with('error_admin', 'Gagal menghapus data admin.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error_admin', 'Error: ' . $e->getMessage());
        }
    }



// ========== JADWAL DOKTER CRUD METHODS ==========
public function storeJadwal(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'poli' => 'required|string|max:255',
        'hari' => 'required|string',
        'waktu' => 'required|string',
        'maximal_reservasi' => 'required|integer|min:1',
    ]);

    try {
        $inserted = DB::table('jadwal')->insert([
            'nama' => $validatedData['nama'],
            'poli' => $validatedData['poli'],
            'hari' => $validatedData['hari'],
            'waktu' => $validatedData['waktu'],
            'maximal_reservasi' => $validatedData['maximal_reservasi'],
        ]);

        if ($inserted) {
            return redirect()->route('admin.dashboard')
                ->with('success_jadwal', 'Jadwal dokter berhasil ditambahkan!');
        } else {
            return redirect()->back()
                ->with('error_jadwal', 'Gagal menyimpan jadwal dokter.')
                ->withInput();
        }
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error_jadwal', 'Error: ' . $e->getMessage())
            ->withInput();
    }
}

public function editJadwal($id)
{
    try {
        $jadwal = DB::table('jadwal')->where('schedule_id', $id)->first();
        
        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data jadwal tidak ditemukan.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}

public function updateJadwal(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'poli' => 'required|string|max:255',
        'hari' => 'required|string',
        'waktu' => 'required|string',
        'maximal_reservasi' => 'required|integer|min:1',
    ]);

    try {
        $jadwal = DB::table('jadwal')->where('schedule_id', $id)->first();
        
        if (!$jadwal) {
            return redirect()->back()
                ->with('error_jadwal', 'Data jadwal tidak ditemukan.');
        }

        $updated = DB::table('jadwal')
            ->where('schedule_id', $id)
            ->update($validatedData);

        if ($updated) {
            return redirect()->route('admin.dashboard')
                ->with('success_jadwal', 'Jadwal dokter berhasil diupdate!');
        } else {
            return redirect()->back()
                ->with('error_jadwal', 'Tidak ada perubahan data atau gagal mengupdate.');
        }
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error_jadwal', 'Error: ' . $e->getMessage())
            ->withInput();
    }
}

public function destroyJadwal($id)
{
    try {
        $jadwal = DB::table('jadwal')->where('schedule_id', $id)->first();
        
        if (!$jadwal) {
            return redirect()->back()
                ->with('error_jadwal', 'Data jadwal tidak ditemukan.');
        }

        $deleted = DB::table('jadwal')->where('schedule_id', $id)->delete();

        if ($deleted) {
            return redirect()->route('admin.dashboard')
                ->with('success_jadwal', 'Jadwal dokter berhasil dihapus!');
        } else {
            return redirect()->back()
                ->with('error_jadwal', 'Gagal menghapus jadwal dokter.');
        }
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error_jadwal', 'Error: ' . $e->getMessage());
    }
}
}