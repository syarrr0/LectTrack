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
        $request->validate([
            'nama' => 'required',
            'department' => 'required',
            'password' => 'required',
        ]);

        // Cari pensyarah
        $lecturer = Lecturer::where('nama', $request->nama)
                            ->where('department', $request->department)
                            ->first();

        // Check password tanpa bcrypt
        if ($lecturer && $lecturer->password === $request->password) 
        {
            // Simpan dalam session
            session([
                'lecturer_id' => $lecturer->id,
                'lecturer_name' => $lecturer->nama,
                'lecturer_department' => $lecturer->department,
            ]);

            // Redirect ke HomeUser bukan ke dashboard lama
            return redirect()->route('user.home');
        }

        return back()->withErrors([
            'login_error' => 'Sorry, Wrong User or Password. Please try again.',
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
            return redirect()->back()->with('success', 'Pensyarah berjaya dipadam.');
        } else {
            return redirect()->back()->with('error', 'Gagal memadam data.');
        }
    }
}
