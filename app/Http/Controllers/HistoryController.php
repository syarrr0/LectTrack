<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index($lecturer_id)
    {
        // 1. Ambil semua rekod untuk pengiraan statistik
        $allHistory = Attendance::where('lecturer_id', $lecturer_id)
                             ->get();

        // 2. Pengiraan Ringkasan Statistik
        $summary = $this->calculateSummary($allHistory);
        
        // 3. Ambil rekod untuk dipaparkan (boleh gunakan $allHistory atau ambil semula jika perlu pagination)
        $history = $allHistory->sortByDesc('date_submit');

        // 4. Dapatkan senarai unik 'selection' (Reason) untuk dropdown filter
        $availableReasons = $allHistory->pluck('selection')->unique()->values()->all();

        return view('history', [
            'history' => $history,
            'lecturer_id' => $lecturer_id,
            'summary' => $summary, // <-- TAMBAHAN: Hantar summary ke view
            'availableReasons' => $availableReasons // <-- TAMBAHAN: Hantar senarai Reason
        ]);
    }

/* ================================
   ATTENDANCE HISTORY SEARCH & FILTER (DIUBAH SUAI)
=================================*/
public function searchAttendanceHistory(Request $request, $lecturer_id)
{
    $query = $request->input('query');
    $reason = $request->input('reason'); // <-- TAMBAHAN: Ambil input reason

    $baseQuery = Attendance::where('lecturer_id', $lecturer_id);
    
    // 1. Logik Penapisan Carian (query: Date/Location)
    if ($query) {
        $baseQuery->where(function($q) use ($query) {
            
            $dateFound = false;
            $formats = ['d M Y', 'd-m-Y', 'Y-m-d'];

            foreach ($formats as $format) {
                try {
                    $date = Carbon::createFromFormat($format, $query);
                    $q->orWhereDate('date_submit', $date->format('Y-m-d'));
                    $dateFound = true;
                    break;
                } catch (\Exception $e) {
                    // skip
                }
            }

            if (!$dateFound) {
                $q->orWhere('location', 'like', '%' . $query . '%');
                // Peringatan: Menambah orWhere('date_submit', 'like', ...) boleh menyebabkan masalah jika query adalah nama lokasi, jadi elakkan jika boleh
            }
        });
    }

    // 2. Logik Penapisan Reason
    if ($reason) {
        $baseQuery->where('selection', $reason);
    }
    
    // 3. Lakukan carian dan sort
    $history = $baseQuery->orderBy('date_submit', 'desc')->get();
    
    // 4. Kira summary dan dapatkan availableReasons untuk view
    $allHistoryForSummary = Attendance::where('lecturer_id', $lecturer_id)->get();
    $summary = $this->calculateSummary($allHistoryForSummary);
    $availableReasons = $allHistoryForSummary->pluck('selection')->unique()->values()->all();

    return view('history', [
        'history' => $history,
        'lecturer_id' => $lecturer_id,
        'summary' => $summary,
        'availableReasons' => $availableReasons,
    ]);
}


/* ================================
   FUNGSI BANTUAN UNTUK MENGIRA SUMMARY
=================================*/
protected function calculateSummary($collection)
{
    // Anda boleh mengubahsuai kriteria di bawah mengikut data sebenar
    $totalRecords = $collection->count();
    $hadir = $collection->whereNotIn('selection', ['CUTI(MC)', 'sick leave'])->count();
    $cuti = $collection->whereIn('selection', ['CUTI(MC)', 'sick leave'])->count();
    $mesyuarat = $collection->where('selection', 'MESYUARAT')->count();

    // Tambah pengiraan peratusan jika perlu
    $hadirPercentage = $totalRecords > 0 ? round(($hadir / $totalRecords) * 100, 1) : 0;

    return [
        'totalRecords' => $totalRecords,
        'hadir' => $hadir,
        'cuti' => $cuti,
        'mesyuarat' => $mesyuarat,
        'hadirPercentage' => $hadirPercentage
    ];
}


}