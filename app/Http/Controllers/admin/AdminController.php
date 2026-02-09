<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
    $request->validate([
        'title'   => 'required',
        'date'    => 'required|date',
        'content' => 'required',
    ]);

    // Controller tolong kirakan hari (Monday, Tuesday, etc)
    $dayName = \Carbon\Carbon::parse($request->date)->format('l');

    \App\Models\SiteNotification::create([
        'title'   => $request->title,
        'date'    => $request->date,
        'content' => $request->content,
        'day'     => $dayName, // Masukkan hari yang dikira
    ]);

    return back()->with('success', 'Announcement posted!');
}

    // Fungsi untuk paparkan page notifications
    public function notifications() 
    {
        // Kita ambil semua notifikasi untuk dipaparkan dalam table di bawah form nanti (jika mahu)
        $notifications = SiteNotification::latest()->get();
        
        // Pastikan hantar data guna compact() supaya blade boleh guna variable $notifications
        return view('admin.notifications', compact('notifications'));
    }

    // Tambah fungsi ini di dalam class AdminController anda

public function fetchNotifications() 
{
    $userId = auth()->id();

    $notifications = \DB::table('site_notifications')
        ->leftJoin('user_notifications', function($join) use ($userId) {
            $join->on('site_notifications.id', '=', 'user_notifications.notification_id')
                 ->where('user_notifications.user_id', '=', $userId);
        })
        // PENTING: Tapis supaya yang is_deleted = 1 TIDAK KELUAR
        ->where(function($query) {
            $query->where('user_notifications.is_deleted', 0)
                  ->orWhereNull('user_notifications.is_deleted');
        })
        ->select('site_notifications.*', 'user_notifications.is_read')
        ->orderBy('site_notifications.created_at', 'desc')
        ->get();

    $unreadCount = $notifications->where('is_read', 0)->count();

    return response()->json([
        'notifications' => $notifications,
        'unreadCount' => $unreadCount
    ]);
}
public function markAllAsRead() {
    $userId = auth()->id();
    $notificationIds = \DB::table('site_notifications')->pluck('id');

    foreach ($notificationIds as $id) {
        // Gunakan updateOrInsert dengan kriteria yang tepat
        \DB::table('user_notifications')->updateOrInsert(
            ['user_id' => $userId, 'notification_id' => $id],
            ['is_read' => 1, 'updated_at' => now()] // Gunakan 1 untuk tinyint true
        );
    }
    return response()->json(['success' => true]);
}

public function clearAllNotifications() {
    try {
        // 1. Permanently delete all user-specific status (read/delete flags)
        \DB::table('user_notifications')->delete();

        // 2. Permanently delete the actual notifications for everyone
        \DB::table('site_notifications')->delete();

        return response()->json([
            'success' => true,
            'message' => 'All notifications have been deleted globally.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'System Error: ' . $e->getMessage()
        ], 500);
    }
}
}