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

    // Tambah fungsi ini di dalam class AdminController anda

public function fetchNotifications() 
{
    $userId = auth()->id(); // Pastikan user dah login

    // Ambil notifikasi yang BELUM dipadam oleh user ini
    $notifications = \DB::table('site_notifications')
        ->leftJoin('user_notifications', function($join) use ($userId) {
            $join->on('site_notifications.id', '=', 'user_notifications.notification_id')
                 ->where('user_notifications.user_id', '=', $userId);
        })
        ->where(function($query) {
            $query->where('user_notifications.is_deleted', false)
                  ->orWhereNull('user_notifications.is_deleted');
        })
        ->select('site_notifications.*', 'user_notifications.is_read')
        ->orderBy('site_notifications.created_at', 'desc')
        ->get();

    // Kira badge (Hanya yang is_read = false)
    $unreadCount = $notifications->where('is_read', 0)->count();

    return response()->json([
        'notifications' => $notifications,
        'unreadCount' => $unreadCount
    ]);
}
public function markAllAsRead() {
    $userId = auth()->id();
    $notis = \DB::table('site_notifications')->pluck('id');

    foreach($notis as $id) {
        \DB::table('user_notifications')->updateOrInsert(
            ['user_id' => $userId, 'notification_id' => $id],
            ['is_read' => true, 'updated_at' => now()]
        );
    }
    return response()->json(['success' => true]);
}

public function clearAllNotifications() {
    $userId = auth()->id();
    $notis = \DB::table('site_notifications')->pluck('id');

    foreach($notis as $id) {
        \DB::table('user_notifications')->updateOrInsert(
            ['user_id' => $userId, 'notification_id' => $id],
            ['is_deleted' => true, 'updated_at' => now()]
        );
    }
    return response()->json(['success' => true]);
}
}