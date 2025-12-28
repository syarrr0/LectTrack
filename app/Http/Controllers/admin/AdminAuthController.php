<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function showLogin()
{
    return view('admin.login');
}
    public function login(Request $request)
{
    $request->validate([
        'name' => 'required',
        'password' => 'required',
    ]);

    // cari admin ikut name
    $admin = DB::table('admins')->where('name', $request->name)->first();

    if (!$admin) {
        return back()->with('error', 'Nama atau kata laluan salah.');
    }

    // password tidak encrypted
    if ($request->password !== $admin->password) {
        return back()->with('error', 'Nama atau kata laluan salah.');
    }

    // Simpan session
    session([
        'admin_logged_in' => true,
        'admin_name' => $admin->name
    ]);

    return redirect()->route('admin.dashboard');
}

}
