<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AIChatController extends Controller
{
    public function chat(Request $request)
    {
        $lang = $request->lang ?? 'my';
        $lecturerID = session('lecturer_id');

        if (!$lecturerID) {
            return response()->json(['reply' => $lang == 'en' ? 'Please log in first.' : 'Sila login terlebih dahulu.']);
        }

        $lecturer = Lecturer::find($lecturerID);
        $message = strtolower($request->message);

        // 1. Welcome Message
        if ($message === 'start_session_hello') {
            return response()->json(['reply' => $this->getWelcomeMessage($lang)]);
        }

        // 2. Intent Detection
        if (str_contains($message, 'bulan')) {
            return response()->json(['reply' => $this->laporanBulanan($lecturer, $lang)]);
        }

        if (str_contains($message, 'tahun')) {
            if (str_contains($message, 'print') || str_contains($message, 'cetak')) {
                return response()->json(['reply' => $this->printLaporanTahunan($lecturer, $lang)]);
            }
            return response()->json(['reply' => $this->laporanTahunan($lecturer, $lang)]);
        }

        if (str_contains($message, 'baki') || str_contains($message, 'mc')) {
            return response()->json(['reply' => $this->bakiCuti($lecturer, $lang)]);
        }

        // Fallback jika arahan tidak difahami
        return response()->json([
            'reply' => $lang == 'en' 
            ? "I can only help with: Monthly Report, Yearly Report, Leave Balance, or Printing Yearly Report." 
            : "Saya hanya boleh membantu dengan: Laporan Bulanan, Laporan Tahunan, Baki Cuti, atau Cetak Laporan Tahunan."
        ]);
    }

    private function getWelcomeMessage($lang)
    {
        return $lang == 'en' 
            ? "👋 Hi! I'm Stella. How can I help you today?\n Monthly Report\n2. Yearly Report\n3. Leave Balance\n4. Print Yearly Report"
            : "👋 Hai! Saya Stella. Apa yang boleh saya bantu?\n- Laporan Bulanan\n- Laporan Tahunan\n- Baki Cuti\n- Cetak Laporan Tahunan";
    }

    // FUNGSI 1: LAPORAN BULANAN
    private function laporanBulanan($lecturer, $lang)
    {
        $month = now()->month;
        $records = Attendance::where('lecturer_id', $lecturer->id)
            ->whereMonth('date_submit', $month)
            ->get();

        return $this->formatReport("Laporan Bulanan", $records, $lecturer->nama);
    }

    // FUNGSI 2: LAPORAN TAHUNAN
    private function laporanTahunan($lecturer, $lang)
    {
        $year = now()->year;
        $records = Attendance::where('lecturer_id', $lecturer->id)
            ->whereYear('date_submit', $year)
            ->get();

        return $this->formatReport("Laporan Tahunan ($year)", $records, $lecturer->nama);
    }

    // FUNGSI 3: BAKI CUTI MC
    private function bakiCuti($lecturer, $lang)
    {
        $totalMC = Attendance::where('lecturer_id', $lecturer->id)
            ->where('selection', 'CUTI(MC)')
            ->whereYear('date_submit', now()->year)
            ->get()
            ->sum(function ($r) {
                return Carbon::parse($r->date_submit)->diffInDays(Carbon::parse($r->date_end)) + 1;
            });

        $quota = 10;
        $balance = max(0, $quota - $totalMC);

        return $lang == 'en'
            ? "Your remaining MC leave is **$balance days** out of $quota days for this year."
            : "Baki cuti MC anda ialah **$balance hari** daripada $quota hari untuk tahun ini.";
    }

    // FUNGSI 4: PRINT LAPORAN TAHUNAN (MENGHASILKAN LINK)
    private function printLaporanTahunan($lecturer, $lang)
    {
        // Di sini kita hantar link ke route history anda dengan filter tahun
        $url = route('attendance.history', $lecturer->id) . "?year=" . now()->year;
        
        return $lang == 'en'
            ? "You can print your annual report here: [Click to View & Print]($url)\n*(Please use Ctrl+P on the page)*"
            : "Anda boleh mencetak laporan tahunan anda di sini: [Klik untuk Lihat & Cetak]($url)\n*(Sila tekan Ctrl+P pada halaman tersebut)*";
    }

    // Helper untuk cantikkan teks laporan
    private function formatReport($title, $records, $name)
    {
        if ($records->isEmpty()) return "Tiada rekod ditemui untuk $title.";

        $counts = $records->groupBy('selection')->map->count();
        
        $msg = "📊 **$title**\nNama: $name\n";
        foreach ($counts as $type => $count) {
            $msg .= "• $type: $count\n";
        }
        $msg .= "\nJumlah Keseluruhan: " . $records->count() . " aktiviti.";
        return $msg;
    }
}