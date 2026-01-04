<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\LecturerAuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\IndexadminController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\PasswordController;

// =============================
// MAIN PAGE
// =============================
Route::get('/', [HomeController::class, 'index'])->name('home');


// =============================
// SIGN UP (REGISTER LECTURER)
// =============================
Route::get('/signup', [LecturerController::class, 'showSignup'])->name('signup');
Route::post('/signup', [LecturerController::class, 'processSignup'])->name('signup.process');


// =============================
// LOGIN + LOGOUT
// =============================
Route::get('/lecturer/login', [LecturerAuthController::class, 'showLoginForm'])
    ->name('lecturer.login');

Route::post('/lecturer/login', [LecturerAuthController::class, 'login'])
    ->name('lecturer.login.submit');

Route::post('/lecturer/logout', [LecturerAuthController::class, 'logout'])
    ->name('lecturer.logout');


// =============================
// AFTER LOGIN → DASHBOARD USER
// =============================
Route::get('/user/home', [HomeUserController::class, 'index'])
    ->name('user.home');

// Jika kamu perlu dashboard pensyarah
Route::get('/lecturer/dashboard', [LecturerAuthController::class, 'dashboard'])
    ->name('lecturer.dashboard');


// =============================
// ATTENDANCE FORM
// =============================
Route::get('/attendance/form', [AttendanceController::class, 'showForm'])
    ->name('attendance.form');

Route::post('/attendance/submit', [AttendanceController::class, 'submitForm'])
    ->name('attendance.submit');


// =============================
// ATTENDANCE HISTORY
// =============================

// Papar history ikut lecturer ID
Route::get('/attendance/history/{lecturer_id}', [HistoryController::class, 'index'])
    ->name('attendance.history');

// Route yang DIBETULKAN
Route::get('/attendance/history/search/{lecturer_id}', [HistoryController::class, 'searchAttendanceHistory'])
->name('attendance.history.search');


// =============================
// PERSONAL INFORMATION
// =============================

// Papar maklumat lecturer
Route::get('/lecturer/information', 
    [InformationController::class, 'index']
)->name('lecturer.information');


// Papar page untuk Edit Information
Route::get('/lecturer/edit', [LecturerController::class, 'editInformation'])
    ->name('lecturer.edit');

// Proses update profile
Route::post('/lecturer/update', [LecturerController::class, 'updateInformation'])
    ->name('lecturer.update');


//Bahagian Help/Support

Route::get('/help', function () {
    return view('help');
})->name('lecturer.help');




    
// ADMIN

// Papar page login admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

// Proses login admin
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

// Dashboard admin
Route::get('/admin/dashboard', [IndexadminController::class, 'index'])
    ->name('admin.dashboard');

// Admin index (senarai lecturer)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('index');
});

// UNTUK AI PUNYA
Route::post('/ai/chat', [AIChatController::class, 'chat'])
    ->name('ai.chat')
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])
    ->name('admin.dashboard');

    Route::get('/admin/dashboard/realtime', [AdminDashboardController::class, 'realtimeStats']);

Route::get('/admin/report', [AdminDashboardController::class, 'report'])
    ->name('admin.report');

// LAPORAN ADMIN
Route::get('/lecturer/report/{id}', [LaporanController::class, 'showReport'])
    ->name('lecturer.report');



Route::get('/lecturer/print/{id}', [\App\Http\Controllers\Admin\PrintController::class, 'printReport']);

// log out admin
Route::post('/logout', function (Request $request) {
    Auth::logout();
    
    $request.session()->invalidate();
    
    $request.session()->regenerateToken();

    return redirect('/'); 
})->name('logout');

// UNTUK CHANGE PASS

// Gunakan route ini sahaja untuk sistem penukaran kata laluan baru
Route::post('/request-change-password', [PasswordController::class, 'requestOTP'])->name('user.request_change_password');
Route::get('/change-password', [PasswordController::class, 'showChangeForm'])->name('password.change_form');
Route::post('/update-password', [PasswordController::class, 'updatePassword'])->name('password.update_process');

// noti admin
Route::get('/admin/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
// Route untuk membolehkan HomeUser.blade.php mengambil data notifikasi
Route::get('/api/notifications/fetch', [AdminController::class, 'fetchNotifications']);
Route::post('/api/notifications/mark-read', [AdminController::class, 'markAllAsRead']);
Route::post('/api/notifications/clear-all', [AdminController::class, 'clearAllNotifications']);

// Route untuk simpan maklumat (POST) - INI YANG HILANG
Route::post('/admin/notifications/store', [AdminController::class, 'storeNotification'])->name('admin.notifications.store');