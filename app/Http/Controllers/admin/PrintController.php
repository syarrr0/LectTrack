<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class PrintController extends Controller
{
    /**
     * Fetches all lecturer and attendance data and passes it to the print view.
     * The view is styled to be an A4 PDF template.
     *
     * @param int $id Lecturer ID
     * @return \Illuminate\View\View
     */
    public function printReport($id)
    {
        // ----------------------------------------------------
        // 1. FETCH LECTURER PROFILE DATA
        // ----------------------------------------------------
        $lecturer = DB::table('lecturers')
                        ->where('id', $id)
                        ->first();

        if (!$lecturer) {
            abort(404, 'Lecturer not found.');
        }

        // ----------------------------------------------------
        // 2. FETCH AND CALCULATE ATTENDANCE DATA (Last 1 Year)
        // ----------------------------------------------------
        
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subYear(); 
        
        // Fetch all attendance records for the lecturer within the period
        $attendanceRecords = DB::table('attendances')
                                ->where('lecturer_id', $id)
                                ->whereBetween('date_submit', [$startDate, $endDate])
                                ->orderBy('date_submit', 'asc') // Sort for clear reporting
                                ->get();
        
        // Status calculations (Same logic as LaporanController)
        $statusDays = [
            'CUTI(MC)' => 0,
            'PROGRAM' => 0,
            'MESYUARAT' => 0,
            'KURSUS/BENGKEL' => 0,
            'OTHERS' => 0,
        ];

        foreach ($attendanceRecords as $record) {
            $submit = Carbon::parse($record->date_submit);
            $end = Carbon::parse($record->date_end);
            $days = $submit->diffInDays($end) + 1; 

            $selection = strtoupper($record->selection);
            if (array_key_exists($selection, $statusDays)) {
                $statusDays[$selection] += $days;
            } else {
                $statusDays['OTHERS'] += $days; 
            }
        }
        
        $total_days_in_period = $startDate->diffInDays($endDate); 
        $total_days_status = array_sum($statusDays); 

        // Estimated Days In-College Duty
        $days_in_college = max(0, $total_days_in_period - $total_days_status); 

        // Calculation for summary statistics
        $days_off_mc = $statusDays['CUTI(MC)']; 
        $days_annual_leave = 0; // Based on your DB, annual leave is not explicitly tracked separately.
        $percentage_present = round(($days_in_college / $total_days_in_period) * 100, 1);
        
        // ----------------------------------------------------
        // 3. PASS DATA TO VIEW
        // ----------------------------------------------------

        return view('admin.print', compact( 
            'lecturer', 
            'attendanceRecords', // New: Pass raw records for the table
            'percentage_present',
            'days_annual_leave', 
            'total_days_in_period',
            'days_off_mc',
            'startDate',
            'endDate'
        ));
    }
}