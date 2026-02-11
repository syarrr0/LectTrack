<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    // Kita buat array constants supaya senang nak maintain ejaan selection
    private $leaveTypes = ['%Cuti Sakit (MC)%', '%Cuti Rehat Khas (CRK)%', '%Cuti Tanpa Rekod (CTR)%'];
    private $dutyTypes = ['MESYUARAT', 'PROGRAM', 'KURSUS/BENGKEL'];

   public function dashboard()
    {
        $today = Carbon::today();
        $totalLecturers = Lecturer::count(); 

        // 1. Kira Cuti (Range Logic)
        $sickLeave = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->where(function($q) {
                foreach($this->leaveTypes as $type) {
                    $q->orWhere('selection', 'LIKE', $type);
                }
            })
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        // 2. Kira Official Duty (Range Logic - MESTI SAMA DENGAN DUTYLIST)
        $outsideDuty = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', $this->dutyTypes)
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $inCollege = max(0, $totalLecturers - ($sickLeave + $outsideDuty));

        return view('admin.dashboard', compact('totalLecturers', 'inCollege', 'sickLeave', 'outsideDuty'));
    }

    public function getRealtimeData()
    {
        $today = Carbon::today();
        $totalLecturers = Lecturer::count();
        
        $sickLeave = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->where(function($q) {
                foreach($this->leaveTypes as $type) {
                    $q->orWhere('selection', 'LIKE', $type);
                }
            })
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $outsideDuty = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', $this->dutyTypes)
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        return response()->json([
            'totalLecturers' => $totalLecturers,
            'sickLeave' => $sickLeave,
            'outsideDuty' => $outsideDuty,
            'inCollege' => max(0, $totalLecturers - ($sickLeave + $outsideDuty)),
        ]);
    }

   public function dutyList()
    {
        $today = Carbon::today();

        // Ambil SEMUA rekod yang aktif harini (Range Logic)
        $dutyRecords = Attendance::with('lecturer')
            ->whereHas('lecturer') 
            ->whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', $this->dutyTypes)
            ->get()
            ->unique('lecturer_id'); // Pastikan 1 orang 1 rekod

        // Group data untuk dipaparkan mengikut jabatan di Blade
        $lecturersOnDuty = $dutyRecords->map(function($attendance) {
            // Kita attach kan info attendance ke dalam object lecturer supaya boleh display kat blade
            $attendance->lecturer->current_selection = $attendance->selection;
            $attendance->lecturer->current_location = $attendance->location;
            $attendance->lecturer->current_remarks = $attendance->remarks;
            return $attendance->lecturer;
        })->groupBy('department');

        return view('admin.duty_list', compact('lecturersOnDuty'));
    }

    public function leaveList()
    {
        $today = Carbon::today();

        $leaveRecords = Attendance::with('lecturer')
            ->whereHas('lecturer')
            ->whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->where(function($q) {
                foreach($this->leaveTypes as $type) {
                    $q->orWhere('selection', 'LIKE', $type);
                }
            })
            ->get()
            ->unique('lecturer_id'); // <--- PENTING: 1 orang 1 rekod dalam senarai

        $lecturersOnLeave = $leaveRecords->map(function($attendance) {
            return $attendance->lecturer;
        })->groupBy('department');

        return view('admin.leave_list', compact('lecturersOnLeave'));
    }

    public function listInCollege()
    {
        $today = Carbon::today();

        // Tapis ID staf yang bercuti atau tugas luar
        $notInCollegeIds = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->where(function($q) {
                // Tapis Cuti
                foreach($this->leaveTypes as $type) {
                    $q->orWhere('selection', 'LIKE', $type);
                }
                // Tapis Tugas Luar
                $q->orWhereIn('selection', $this->dutyTypes);
            })
            ->pluck('lecturer_id')
            ->unique();

        $lecturersInCollege = Lecturer::whereNotIn('id', $notInCollegeIds)
            ->orderBy('department', 'asc')
            ->orderBy('nama', 'asc')
            ->get()
            ->groupBy('department');

        return view('admin.in_college_list', compact('lecturersInCollege'));
    }

    // Fungsi Report (Dikekalkan tapi diselaraskan ejaan)
    public function report()
    {
        $currentYear = Carbon::now()->year;
        $totalLecturers = Lecturer::count();
        $totalRecords = Attendance::count(); 
        $totalDutyTypes = Attendance::distinct('selection')->count('selection');
        
        $monthlyData = Attendance::select(
                DB::raw('MONTH(date_submit) as month'),
                DB::raw('COUNT(id) as count')
            )
            ->whereYear('date_submit', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyRecords = array_fill(1, 12, 0);
        foreach ($monthlyData as $month => $count) {
            $monthlyRecords[$month] = $count;
        }

        $selectionCounts = Attendance::select('selection', DB::raw('COUNT(*) as count'))
            ->groupBy('selection')
            ->pluck('count', 'selection')
            ->toArray();
        
        $activeDuty = ($selectionCounts['KURSUS/BENGKEL'] ?? 0);
        $officialDuty = ($selectionCounts['MESYUARAT'] ?? 0) + ($selectionCounts['PROGRAM'] ?? 0);
        
        // Logik ejaan cuti dalam report perlu sama dengan database
        $leaveDuty = 0;
        foreach($selectionCounts as $key => $val) {
            if(str_contains($key, 'Cuti')) $leaveDuty += $val;
        }

        $totalGrouped = max(1, $activeDuty + $officialDuty + $leaveDuty);

        $activePercent = round(($activeDuty / $totalGrouped) * 100);
        $officialPercent = round(($officialDuty / $totalGrouped) * 100);
        $leavePercent = round(($leaveDuty / $totalGrouped) * 100);
        
        return view('admin.report', compact(
            'totalLecturers', 'totalRecords', 'totalDutyTypes', 'monthlyRecords',
            'activePercent', 'officialPercent', 'leavePercent'
        ));
    }
}