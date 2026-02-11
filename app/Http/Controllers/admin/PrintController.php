<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class PrintController extends Controller
{
    public function printReport($id)
    {
        // 1. FETCH LECTURER PROFILE DATA
        $lecturer = DB::table('lecturers')->where('id', $id)->first();

        if (!$lecturer) {
            abort(404, 'Lecturer not found.');
        }

        // 2. FETCH AND CALCULATE ATTENDANCE DATA (Last 1 Year)
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subYear(); 
        
        $attendanceRecords = DB::table('attendances')
                                ->where('lecturer_id', $id)
                                ->whereBetween('date_submit', [$startDate, $endDate])
                                ->orderBy('date_submit', 'asc')
                                ->get();
        
        // Inisialisasi pembilang untuk cuti baru
        $total_leave_days = 0; 
        
        $statusDays = [
            'CUTI(MC)' => 0,
            'CUTI REHAT KHAS (CRK)' => 0,
            'CUTI TANPA REKOD (CTR)' => 0,
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

            // Logik baru: Semak jika pilihan mengandungi kata kunci cuti
            if (str_contains($selection, 'CUTI SAKIT') || str_contains($selection, 'MC')) {
                $statusDays['CUTI(MC)'] += $days;
                $total_leave_days += $days;
            } elseif (str_contains($selection, 'CRK') || str_contains($selection, 'REHAT KHAS')) {
                $statusDays['CUTI REHAT KHAS (CRK)'] += $days;
                $total_leave_days += $days;
            } elseif (str_contains($selection, 'CTR') || str_contains($selection, 'TANPA REKOD')) {
                $statusDays['CUTI TANPA REKOD (CTR)'] += $days;
                $total_leave_days += $days;
            } elseif (array_key_exists($selection, $statusDays)) {
                $statusDays[$selection] += $days;
            } else {
                $statusDays['OTHERS'] += $days; 
            }
        }
        
        $total_days_in_period = $startDate->diffInDays($endDate); 
        $total_days_status = array_sum($statusDays); 

        $days_in_college = max(0, $total_days_in_period - $total_days_status); 

        // Calculation for summary statistics
        // Sekarang $days_off_leave merangkumi MC + CRK + CTR
        $days_off_leave = $total_leave_days; 
        $percentage_present = round(($days_in_college / $total_days_in_period) * 100, 1);
        
        // 3. PASS DATA TO VIEW
return view('admin.print', compact( 
    'lecturer', 
    'attendanceRecords', 
    'percentage_present',
    'total_days_in_period',
    'days_off_leave', // Pastikan nama ini ada di sini
    'startDate',
    'endDate'
));
    }
}