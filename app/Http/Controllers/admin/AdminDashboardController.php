<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        $totalLecturers = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $sickLeave = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', ['CUTI(MC)', 'OTHERS'])
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $outsideDuty = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', ['MESYUARAT', 'PROGRAM'])
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $inCollege = max(0, $totalLecturers - ($sickLeave + $outsideDuty));

        return view('admin.dashboard', compact(
            'totalLecturers',
            'inCollege',
            'sickLeave',
            'outsideDuty'
        ));
    }

    public function realtimeStats()
    {
        $today = Carbon::today();

        $totalLecturers = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $sickLeave = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', ['CUTI(MC)', 'OTHERS'])
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $outsideDuty = Attendance::whereDate('date_submit', '<=', $today)
            ->whereDate('date_end', '>=', $today)
            ->whereIn('selection', ['MESYUARAT', 'PROGRAM'])
            ->distinct('lecturer_id')
            ->count('lecturer_id');

        $inCollege = max(0, $totalLecturers - ($sickLeave + $outsideDuty));

        return response()->json([
            'totalLecturers' => $totalLecturers,
            'inCollege' => $inCollege,
            'sickLeave' => $sickLeave,
            'outsideDuty' => $outsideDuty,
        ]);
    }
 public function report()
    {
        $currentYear = Carbon::now()->year;
        
        // --- Summary Boxes Data ---
        
        // Total Registered Lecturers (from 'lecturers' table)
        $totalLecturers = Lecturer::count();
        
        // Total Attendance Records (Total entries in 'attendances' table)
        $totalRecords = Attendance::count(); 
        
        // Total Unique Duty Types (The new metric to replace 'Total Classes')
        $totalDutyTypes = Attendance::distinct('selection')->count('selection');
        
        // --- Monthly Trend Data (Line Chart) ---
        // Count total attendance records per month for the current year.
        $monthlyData = Attendance::select(
                DB::raw('MONTH(date_submit) as month'),
                DB::raw('COUNT(id) as count')
            )
            ->whereYear('date_submit', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Initialize monthly array with 0 and fill in data
        $monthlyRecords = array_fill(1, 12, 0);
        foreach ($monthlyData as $month => $count) {
            $monthlyRecords[$month] = $count;
        }

        // --- Pie Chart Data (Based on Selection Types) ---
        $selectionCounts = Attendance::select('selection', DB::raw('COUNT(*) as count'))
            ->groupBy('selection')
            ->pluck('count', 'selection')
            ->toArray();
        
        // Grouping selections into three categories for the Pie Charts:
        
        // 1. Active Duty (e.g., KURSUS/BENGKEL)
        $activeDuty = ($selectionCounts['KURSUS/BENGKEL'] ?? 0);
        
        // 2. Official Duty (e.g., MESYUARAT, PROGRAM)
        $officialDuty = ($selectionCounts['MESYUARAT'] ?? 0) + ($selectionCounts['PROGRAM'] ?? 0);

        // 3. Leave Duty (e.g., CUTI(MC), OTHERS)
        $leaveDuty = ($selectionCounts['CUTI(MC)'] ?? 0) + ($selectionCounts['OTHERS'] ?? 0);

        // Sum of these three categories for percentage calculation
        $totalGroupedRecords = $activeDuty + $officialDuty + $leaveDuty;

        // Prevent division by zero
        $totalGrouped = max(1, $totalGroupedRecords);

        $activePercent = round(($activeDuty / $totalGrouped) * 100);
        $officialPercent = round(($officialDuty / $totalGrouped) * 100);
        $leavePercent = round(($leaveDuty / $totalGrouped) * 100);
        
        // Pass data to view
        return view('admin.report', compact(
            'totalLecturers',
            'totalRecords',
            'totalDutyTypes',
            'monthlyRecords',
            'activePercent',
            'officialPercent',
            'leavePercent'
        ));
    }
   
}
