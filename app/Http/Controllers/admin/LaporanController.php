<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class LaporanController extends Controller
{
    /**
     * Displays the lecturer report page, fetching all data from the database.
     *
     * @param int $id Lecturer ID
     * @return \Illuminate\View\View
     */
    public function showReport($id)
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
        // 2. FETCH AND CALCULATE ATTENDANCE DATA
        // ----------------------------------------------------
        
        // Set Report Period (e.g., Last 1 Year)
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subYear(); 
        
        // Fetch attendance records within the period
        $attendanceRecords = DB::table('attendances')
                                ->where('lecturer_id', $id)
                                ->whereBetween('date_submit', [$startDate, $endDate])
                                ->get();
        
        // Status categories based on the 'selection' column
        $statusDays = [
            'CUTI(MC)' => 0,
            'PROGRAM' => 0,
            'MESYUARAT' => 0,
            'KURSUS/BENGKEL' => 0,
            'OTHERS' => 0,
        ];

        // Calculate total days for each category
        foreach ($attendanceRecords as $record) {
            $submit = Carbon::parse($record->date_submit);
            $end = Carbon::parse($record->date_end);

            // Calculate days (inclusive)
            $days = $submit->diffInDays($end) + 1; 

            $selection = strtoupper($record->selection);
            if (array_key_exists($selection, $statusDays)) {
                $statusDays[$selection] += $days;
            } else {
                $statusDays['OTHERS'] += $days; 
            }
        }
        
        // ----------------------------------------------------
        // 3. CALCULATION FOR CHARTS AND GRAPHS
        // ----------------------------------------------------
        
        $total_days_in_period = $startDate->diffInDays($endDate); 
        $total_days_status = array_sum($statusDays); 

        // A. PIE CHART (Status Distribution)
        
        // Estimated Days In-College Duty
        $days_in_college = max(0, $total_days_in_period - $total_days_status); 

        $statusDays['Di Kolej (In-College)'] = $days_in_college;
        
        // Calculate percentages
        $statusPercentages = [];
        foreach ($statusDays as $key => $value) {
            if ($value > 0 || $key == 'Di Kolej (In-College)') {
                 $statusPercentages[$key] = round(($value / $total_days_in_period) * 100, 1);
            }
        }
        
        // B. BAR CHART (Attendance vs Leave)

        $days_off_mc = $statusDays['CUTI(MC)']; 
        $days_annual_leave = 0; // Set to 0 as it's not explicitly in DB
        
        // In-College Attendance Percentage (Excl. MC)
        $percentage_present = round(($days_in_college / $total_days_in_period) * 100, 1);

        // ----------------------------------------------------
        // 4. PASS DATA TO VIEW
        // ----------------------------------------------------

        return view('admin.laporan', compact( 
            'lecturer', 
            'statusPercentages',
            'percentage_present',
            'days_annual_leave', 
            'total_days_in_period',
            'days_off_mc'
        ));
    }
}