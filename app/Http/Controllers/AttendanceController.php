<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function showForm(Request $request)
    {
        // Pastikan user sudah login
        if (!$request->session()->has('lecturer_id')) {
            return redirect()->route('lecturer.login');
        }

        return view('form');
    }

    public function submitForm(Request $request)
    {
        // Ambil lecturer_id dari session (LEBIH SELAMAT)
        $lecturer_id = $request->session()->get('lecturer_id');

        if (!$lecturer_id) {
            return redirect()->route('lecturer.login')
                ->withErrors(['login_error' => 'Please log in again.']);
        }

        // Validate tanpa lecturer_id
        $request->validate([
            'date_submit' => 'required|date',
            'date_end' => 'required|date',
            'selection' => 'required',
            'time' => 'required',
            'location' => 'required',
            'remarks' => 'required',
        ]);

        Attendance::create([
            'lecturer_id' => $lecturer_id,
            'date_submit' => $request->date_submit,
            'date_end' => $request->date_end,
            'selection' => $request->selection,
            'time' => $request->time,
            'location' => $request->location,
            'remarks' => $request->remarks,
        ]);

        return back()->with('success', 'Attendance has been successfully recorded!');
    }
}
