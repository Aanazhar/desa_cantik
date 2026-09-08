<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * Tampilkan Halaman Login Admin
     */
    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.site-data');
        }

        return view('admin.login');
    }

    /**
     * Proses Login Admin
     */
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $admin = AdminUser::where('email', $credentials['email'])->first();

    if (!$admin) {
        dd('User dengan email ini TIDAK DITEMUKAN di database');
    }

    if (!Hash::check($credentials['password'], $admin->password)) {
        dd('User ditemukan, TAPI PASSWORD SALAH (kemungkinan karena password di database tidak di-hash dengan bcrypt)');
    }

    session([
        'admin_id'   => $admin->id,
        'admin_name' => $admin->name,
        'desa_id'    => 1,
    ]);

    return redirect()->route('admin.site-data');
}
}