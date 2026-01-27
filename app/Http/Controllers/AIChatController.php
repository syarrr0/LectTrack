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
        $lecturerID = session('lecturer_id');
        if (!$lecturerID) {
            return response()->json(['reply' => 'Please log in first. / Sila log masuk terlebih dahulu.']);
        }

        $lecturer = Lecturer::find($lecturerID);
        $message = strtolower($request->message);

        // 1. PENGESANAN BAHASA AUTOMATIK
        $isMalay = preg_match('/(apa|siapa|kenapa|bagaimana|boleh|tolong|bantu|saya|nak|terima kasih|hai|makan|kerja|sistem|baki|laporan|tahun|bulan|cetak)/i', $message);
        $lang = $isMalay ? 'ms' : 'en';

        // 2. MESEJ SELAMAT DATANG
        if ($message === 'start_session_hello') {
            return response()->json(['reply' => $this->getWelcomeMessage($lang)]);
        }

        // 3. LOGIK LAPORAN (STATISTIK DATABASE)
        if (str_contains($message, 'month') || str_contains($message, 'bulan')) {
            return response()->json(['reply' => $this->laporanBulanan($lecturer, $lang)]);
        }

        if (str_contains($message, 'year') || str_contains($message, 'tahun')) {
            if (str_contains($message, 'print') || str_contains($message, 'cetak')) {
                return response()->json(['reply' => $this->printLaporanTahunan($lecturer, $lang, $message)]);
            }
            return response()->json(['reply' => $this->laporanTahunan($lecturer, $lang, $message)]);
        }

        if (str_contains($message, 'balance') || str_contains($message, 'baki') || str_contains($message, 'mc')) {
            return response()->json(['reply' => $this->checkMCBalance($lecturer, $lang)]);
        }

        // 4. LOGIK "BRAIN MAPPING" (SOALAN UMUM & SISTEM)
        $responses = [
            'ms' => [
                'identiti' => "Saya Stella, pembantu AI khas untuk sistem LectTrack. Saya boleh bantu anda uruskan rekod kehadiran!",
                'khabar' => "Saya sihat dan sedia membantu! Anda apa khabar hari ini?",
                'checkin' => "Untuk Check-In, anda hanya perlu pergi ke Dashboard utama dan klik butang 'Check In'.",
                'terima_kasih' => "Sama-sama! Ada apa-apa lagi yang boleh saya bantu?",
                'default' => "Maaf, saya tidak pasti. Tetapi saya pakar dalam: Laporan Bulanan, Tahunan (contoh: 2025), Baki MC, dan panduan sistem."
            ],
            'en' => [
                'identiti' => "I'm Stella, your dedicated AI assistant for LectTrack. I'm here to make your attendance management easier!",
                'khabar' => "I'm functioning perfectly and ready to help! How are you doing today?",
                'checkin' => "To Check-In, simply go to the main Dashboard and click the 'Check In' button.",
                'terima_kasih' => "You're welcome! I'm always here if you need further assistance.",
                'default' => "I'm not sure about that. However, I can help with: Monthly/Yearly Reports (e.g., 2025), MC Balance, and system guides."
            ]
        ];

        if (str_contains($message, 'siapa') || str_contains($message, 'who are you')) {
            return response()->json(['reply' => $responses[$lang]['identiti']]);
        }
        if (str_contains($message, 'khabar') || str_contains($message, 'how are you')) {
            return response()->json(['reply' => $responses[$lang]['khabar']]);
        }
        if (str_contains($message, 'cara') || str_contains($message, 'how to') || str_contains($message, 'check in')) {
            return response()->json(['reply' => $responses[$lang]['checkin']]);
        }
        if (str_contains($message, 'terima kasih') || str_contains($message, 'thank you') || str_contains($message, 'thanks')) {
            return response()->json(['reply' => $responses[$lang]['terima_kasih']]);
        }

        return response()->json(['reply' => $responses[$lang]['default']]);
    }

    private function getWelcomeMessage($lang)
    {
        return $lang == 'ms' 
            ? "👋 Hai! Saya Stella. Apa yang boleh saya bantu hari ini?\n\n- Laporan Bulanan/Tahunan\n- Baki Cuti MC\n- Cara guna sistem"
            : "👋 Hi! I'm Stella. How can I help you today?\n\n- Monthly/Yearly Reports\n- MC Leave Balance\n- How to use the system";
    }

    private function laporanBulanan($lecturer, $lang)
    {
        $month = now()->month;
        $year = now()->year;
        
        $totalWorkingDays = 0;
        $date = Carbon::create($year, $month, 1);
        while ($date->month == $month) {
            if (!$date->isWeekend()) $totalWorkingDays++;
            $date->addDay();
        }

        $presentDays = Attendance::where('lecturer_id', $lecturer->id)
            ->whereMonth('date_submit', $month)
            ->whereIn('selection', ['HADIR', 'CHECK IN', 'ON-DUTY'])
            ->distinct()
            ->count(DB::raw('DATE(date_submit)'));

        $onLeave = Attendance::where('lecturer_id', $lecturer->id)
            ->whereMonth('date_submit', $month)
            ->where('selection', 'LIKE', '%CUTI%')
            ->count();

        return $this->formatAnalisis($lang == 'ms' ? "Analisis Bulanan" : "Monthly Analysis", $presentDays, $totalWorkingDays, $onLeave, $lang);
    }

    private function laporanTahunan($lecturer, $lang, $message)
    {
        preg_match('/\b(20\d{2})\b/', $message, $matches);
        $year = isset($matches[1]) ? $matches[1] : now()->year;

        $totalWorkingDays = 260; 

        $presentDays = Attendance::where('lecturer_id', $lecturer->id)
            ->whereYear('date_submit', $year)
            ->whereIn('selection', ['HADIR', 'CHECK IN', 'ON-DUTY'])
            ->distinct()
            ->count(DB::raw('DATE(date_submit)'));

        $onLeave = Attendance::where('lecturer_id', $lecturer->id)
            ->whereYear('date_submit', $year)
            ->where('selection', 'LIKE', '%CUTI%')
            ->count();

        $title = ($lang == 'ms' ? "Analisis Tahunan" : "Annual Analysis") . " ($year)";
        return $this->formatAnalisis($title, $presentDays, $totalWorkingDays, $onLeave, $lang);
    }

    private function printLaporanTahunan($lecturer, $lang, $message)
    {
        preg_match('/\b(20\d{2})\b/', $message, $matches);
        $year = isset($matches[1]) ? $matches[1] : now()->year;

        $url = route('attendance.history', $lecturer->id) . "?year=" . $year;
        
        return $lang == 'ms'
            ? "Berikut adalah laporan tahun **$year**: [Klik untuk Cetak]($url)\n*(Sila tekan Ctrl+P)*"
            : "Here is your report for **$year**: [Click to Print]($url)\n*(Please press Ctrl+P)*";
    }

    private function checkMCBalance($lecturer, $lang)
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

        return $lang == 'ms'
            ? "Baki cuti MC anda ialah **$balance hari** daripada $quota hari untuk tahun ini."
            : "Your remaining MC leave is **$balance days** out of $quota days for this year.";
    }

    // FUNGSI PENTING: Untuk mengira peratusan
    private function formatAnalisis($title, $present, $total, $leave, $lang)
    {
        $percentage = ($total > 0) ? round(($present / $total) * 100, 2) : 0;
        
        if ($lang == 'ms') {
            return "📊 **$title**\n" .
                   "------------------------------\n" .
                   "🏢 Kehadiran: **$present / $total Hari**\n" .
                   "📈 Peratus Hadir: **$percentage%**\n" .
                   "🏖️ Jumlah Cuti Rekod: **$leave Hari**\n" .
                   "------------------------------\n" .
                   "Status: " . ($percentage >= 80 ? "✅ Cemerlang" : "⚠️ Perlu Diperbaiki");
        } else {
            return "📊 **$title**\n" .
                   "------------------------------\n" .
                   "🏢 Attendance: **$present / $total Days**\n" .
                   "📈 Attendance Rate: **$percentage%**\n" .
                   "🏖️ Total Leave Recorded: **$leave Days**\n" .
                   "------------------------------\n" .
                   "Status: " . ($percentage >= 80 ? "✅ Excellent" : "⚠️ Needs Improvement");
        }
    }
}