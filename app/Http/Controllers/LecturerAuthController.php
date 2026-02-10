<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;

class LecturerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('lecturer_login');
    }

   public function login(Request $request)
{
    // Validasi hanya nama dan password
    $request->validate([
        'nama' => 'required',
        'password' => 'required',
    ]);

    $inputName = $request->nama;
    $inputPassword = $request->password;

    // 1. Cuba cari dalam table ADMINS dahulu
    $admin = \DB::table('admins')->where('name', $inputName)->first();
    
    if ($admin && $admin->password === $inputPassword) {
        session([
            'admin_logged_in' => true,
            'admin_name' => $admin->name
        ]);
        return redirect()->route('admin.dashboard'); // Terus ke folder admin
    }

    // 2. Jika bukan admin, cari dalam table LECTURERS (guna Model Lecturer)
    $lecturer = \App\Models\Lecturer::where('nama', $inputName)->first();

    if ($lecturer && $lecturer->password === $inputPassword) {
        session([
            'lecturer_id' => $lecturer->id,
            'lecturer_name' => $lecturer->nama,
            'lecturer_department' => $lecturer->department, // Simpan untuk kegunaan sistem
        ]);
        return redirect()->route('user.home');
    }

    // 3. Jika dua-dua tak jumpa
    return back()->withErrors([
        'login_error' => 'Username and Password Invalid',
    ])->withInput();
}
    public function dashboard(Request $request)
    {
        // masih ada route lama, tapi kita perbetulkan supaya tidak crash
        if (!$request->session()->has('lecturer_id')) {
            return redirect()->route('lecturer.login');
        }

        $lecturerID = session('lecturer_id');
        $lecturerName = session('lecturer_name');
        $lecturerDepartment = session('lecturer_department');

        // HomeUser perlukan ID & Name
        return view('HomeUser', [
            'lecturerID' => $lecturerID,
            'lecturerName' => $lecturerName,
            'lecturerDepartment' => $lecturerDepartment
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('lecturer.login');
    }
    public function destroy($id)
    {
        // Padam data dari table lecturers berdasarkan ID
        $deleted = \DB::table('lecturers')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Successfully deleted data.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete data.');
        }
    }
}
