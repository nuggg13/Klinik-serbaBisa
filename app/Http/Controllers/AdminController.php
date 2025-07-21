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
        return view('admin.dashboard');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_nama', 'admin_email']);
        return redirect()->route('admin.login');
    }
}
