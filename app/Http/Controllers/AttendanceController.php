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
    $lecturer_id = $request->session()->get('lecturer_id');

    if (!$lecturer_id) {
        return response()->json(['error' => 'Please log in again.'], 401);
    }

    // Cek jika user pilih kategori CUTI
    $isCuti = ($request->selection === 'CUTI(MC)');

    // 1. Kemaskini Validation
    $request->validate([
        'date_submit' => 'required|date',
        'date_end'    => 'required|date',
        'selection'   => 'required',
        'time'        => $isCuti ? 'nullable' : 'required', // Nullable jika cuti
        'location'    => 'required',
        'remarks'     => 'required',
    ]);

    // 2. Gabungkan "CUTI" dengan jenis spesifik (MC/CRK/CTR)
    $finalSelection = $request->selection;
    if ($isCuti && $request->leave_type) {
        $finalSelection = "CUTI (" . $request->leave_type . ")";
    }

    // 3. Simpan data
    Attendance::create([
        'lecturer_id' => $lecturer_id,
        'date_submit' => $request->date_submit,
        'date_end'    => $request->date_end,
        'selection'   => $finalSelection, 
        'time'        => $isCuti ? null : $request->time, // Simpan null jika cuti
        'location'    => $request->location,
        'remarks'     => $request->remarks,
    ]);

    // Berikan respon JSON kerana Blade anda menggunakan fetch()
    return response()->json(['success' => true]);
}
}
