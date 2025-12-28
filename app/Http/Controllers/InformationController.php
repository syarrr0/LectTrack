<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
   public function index()
{
    $lecturerID = session('lecturer_id');

    $lecturer = DB::table('lecturers')
        ->where('id', $lecturerID)
        ->first();

    $attendance = DB::table('attendances')
        ->where('lecturer_id', $lecturerID)
        ->orderBy('date_submit', 'DESC')
        ->orderBy('time', 'DESC')
        ->first();

    // 💡 STATISTIK BARU UNTUK CARD KIRI & KANAN (DATA DUMMY/CONTOH)
    $stats = [
        'courses_held' => 5,        // Jumlah Kursus Dipegang
        'total_students' => 180,    // Jumlah Pelajar Keseluruhan
        'office_hours' => 'Isnin & Rabu (10:00 - 12:00)', // Waktu Pejabat
        'attendance_rate' => '95%', // Peratusan Kehadiran Tepat Masa Bulan Ini
        'office_room' => 'Blok A, Bilik 305' // Lokasi Pejabat
    ];
    // -----------------------------------------------------------

    return view('information', [
        'lecturer' => $lecturer,
        'attendance' => $attendance,
        'stats' => $stats // Hantar data statistik ke view
    ]);
}

}