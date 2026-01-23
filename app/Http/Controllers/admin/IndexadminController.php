<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Http\Controllers\Controller;

class IndexadminController extends Controller
{
   public function index()
    {
        // 1. Dapatkan tarikh hari ini
        $today = Carbon::today();

        // 2. Kira jumlah keseluruhan pensyarah dalam database
        $totalLecturers = Lecturer::count();

        // 3. Kira yang Cuti (On Leave) hari ini
        $sickLeave = Attendance::whereDate('date_submit', '<=', $today)
                                ->whereDate('date_end', '>=', $today)
                                ->where('selection', 'CUTI')
                                ->count();

        // 4. Kira yang Tugasan Luar (Outside Duty) hari ini
        // Mengikut data 3.sql, selection yang terlibat adalah KURSUS/BENGKEL
        $outsideDuty = Attendance::whereDate('date_submit', '<=', $today)
                                  ->whereDate('date_end', '>=', $today)
                                  ->whereIn('selection', ['KURSUS', 'BENGKEL', 'KURSUS/BENGKEL'])
                                  ->count();

        // 5. LOGIK UTAMA: Total - (Cuti + Luar) = In College
        $inCollege = $totalLecturers - ($sickLeave + $outsideDuty);

        // Pastikan nilai tidak negatif
        $inCollege = $inCollege < 0 ? 0 : $inCollege;

        return view('admin.Dashboard', compact('inCollege', 'sickLeave', 'outsideDuty', 'totalLecturers'));
    }
    
}

?>