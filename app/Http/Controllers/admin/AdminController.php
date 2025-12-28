<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\SiteNotification;
use Illuminate\Http\Request; // <--- WAJIB ADA BARIS INI

class AdminController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::orderBy('nama')->get();
        return view('admin.index', compact('lecturers'));
    }
    
    // Fungsi untuk simpan notifikasi
    public function storeNotification(Request $request) 
    {
        // Sebaiknya buat validation supaya database tak error kalau admin tertinggal input
        $request->validate([
            'title'   => 'required',
            'day'     => 'required',
            'date'    => 'required|date',
            'content' => 'required',
        ]);

        SiteNotification::create([
            'title'   => $request->title,
            'day'     => $request->day,
            'date'    => $request->date,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Notification pushed successfully!');
    }

    // Fungsi untuk paparkan page notifications
    public function notifications() 
    {
        // Kita ambil semua notifikasi untuk dipaparkan dalam table di bawah form nanti (jika mahu)
        $notifications = SiteNotification::latest()->get();
        
        // Pastikan hantar data guna compact() supaya blade boleh guna variable $notifications
        return view('admin.notifications', compact('notifications'));
    }
}