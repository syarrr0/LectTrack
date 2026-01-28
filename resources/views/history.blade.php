<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Attendance History | LectTrack 2027</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        :root {
            --navy-deep: #001A35;
            --navy-soft: #002B5B;
            --light-blue-bg: #F0F7FF;
            --head-bg: #c7d5e4;
            --accent-blue: #0070FF;
            --white: #FFFFFF;
            --glass-white: rgba(255, 255, 255, 0.75);
            --border-subtle: rgba(0, 26, 53, 0.08);
        }

        [x-cloak] { display: none !important; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-blue-bg);
            color: var(--navy-deep);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* LIQUID GLASS HEADER */
        .header {
            position: fixed; top: 0; width: 100%;
            padding: 12px 32px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(164, 184, 247, 0.23);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 1000;
        }

        /* IOS LIQUID BUTTON */
        .back-link {
            background: var(--navy-deep);
            color: var(--white);
            padding: 10px 24px;
            border-radius: 100px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 15px rgba(0, 26, 53, 0.2);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .back-link:hover {
            transform: scale(1.05) translateY(-2px);
            background: var(--accent-blue);
            box-shadow: 0 12px 20px rgba(0, 112, 255, 0.3);
        }

        .glass-pill {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 800;
            color: var(--navy-soft);
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }

        .main-content { padding-top: 110px; padding-bottom: 60px; }
        
        /* CATEGORY STYLING */
        .category-divider {
            display: flex; align-items: center; margin: 50px 0 25px;
        }
        .category-divider::before, .category-divider::after {
            content: ""; flex: 1; height: 1px; background: linear-gradient(to right, transparent, rgba(0,26,53,0.1), transparent);
        }
        .category-badge {
            padding: 8px 20px; background: var(--navy-deep); 
            border-radius: 100px; font-weight: 800; font-size: 11px;
            text-transform: uppercase; letter-spacing: 1.5px; color: var(--white);
            margin: 0 20px;
        }

        /* CARD STYLE */
        .card-premium {
            background: var(--white);
            border-radius: 32px;
            border: 1px solid var(--border-subtle);
            padding: 24px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px -10px rgba(0, 26, 53, 0.05);
        }
        .card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(0, 26, 53, 0.12);
            border-color: var(--accent-blue);
        }

        /* LIST VIEW */
        .list-container {
            background: var(--white); border-radius: 32px; overflow: hidden;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 10px 30px rgba(0, 26, 53, 0.05);
        }

        .animate-reveal { opacity: 0; transform: translateY(20px); }
    </style>
</head>

<body x-data="{ 
    currentView: localStorage.getItem('viewPref') || 'card',
    setView(v) { this.currentView = v; localStorage.setItem('viewPref', v); }
}">

<div class="header">
    <div class="flex flex-col">
      
        <h1 class="text-2xl font-black tracking-tighter text-slate-900">Lecturer History</h1>
    </div>
    
    <div class="flex items-center space-x-4">
        <div id="clock" class="hidden md:flex glass-pill items-center gap-2">
            <i class="far fa-clock text-blue-500"></i>
            <span>Loading...</span>
        </div>
        <button onclick="window.history.back()" class="back-link">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </button>
    </div>
</div>

<div class="main-content">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach([
                ['Total Records', $summary['totalRecords'], 'fa-database', 'bg-blue-500'],
                ['Present', $summary['hadir'], 'fa-check-circle', 'bg-emerald-500'],
                ['Leave/MC', $summary['cuti'], 'fa-calendar-minus', 'bg-amber-500'],
                ['Official Duty', $summary['mesyuarat'], 'fa-briefcase', 'bg-violet-500']
            ] as $stat)
            <div class="animate-reveal card-premium flex flex-col items-center text-center">
                <div class="{{ $stat[3] }} w-10 h-10 rounded-2xl flex items-center justify-center text-white mb-3 shadow-lg">
                    <i class="fas {{ $stat[2] }}"></i>
                </div>
                <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">{{ $stat[0] }}</p>
                <p class="text-3xl font-black text-slate-900">{{ $stat[1] }}</p>
            </div>
            @endforeach
        </div>

        <div class="animate-reveal bg-white/80 backdrop-blur-md p-3 rounded-[35px] border border-white shadow-xl mb-10 flex flex-wrap gap-3 items-center">
            <form action="{{ route('attendance.history.search', $lecturer_id) }}" method="GET" class="flex flex-wrap gap-2 flex-grow">
                <div class="relative flex-grow min-w-[250px]">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by location or remarks..." 
                        class="w-full bg-slate-50 border-none rounded-[25px] pl-12 pr-6 py-4 text-sm font-semibold focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                </div>
                
                <select name="reason" class="bg-slate-50 border-none rounded-[25px] px-6 py-4 text-sm font-bold text-slate-700 outline-none appearance-none">
                    <option value="">All Status</option>
                    @foreach($availableReasons as $r)
                        <option value="{{ $r }}" {{ request('reason') == $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-[25px] font-black hover:bg-navy-deep transition-all text-sm uppercase tracking-widest shadow-lg shadow-blue-200">
                    Find
                </button>
            </form>

            <div class="flex bg-slate-100 p-1.5 rounded-[22px]">
                <button @click="setView('card')" :class="currentView === 'card' ? 'bg-white shadow-md text-blue-600' : 'text-slate-400'" class="w-12 h-12 rounded-[18px] transition-all flex items-center justify-center"><i class="fas fa-th-large"></i></button>
                <button @click="setView('list')" :class="currentView === 'list' ? 'bg-white shadow-md text-blue-600' : 'text-slate-400'" class="w-12 h-12 rounded-[18px] transition-all flex items-center justify-center"><i class="fas fa-list-ul"></i></button>
            </div>
        </div>

        @php
            $today = \Carbon\Carbon::today();
            // Data dibahagikan mengikut tahun 2027 sebagai fokus utama
            $comingSoon = $history->filter(fn($item) => \Carbon\Carbon::parse($item->date_submit)->gt($today));
            $currentYear = $history->filter(fn($item) => \Carbon\Carbon::parse($item->date_submit)->lte($today) && \Carbon\Carbon::parse($item->date_submit)->year == 2027);
            $pastRecords = $history->filter(fn($item) => \Carbon\Carbon::parse($item->date_submit)->year < 2027);
            
            $renderRows = function($items) {
                $html = '';
                foreach($items as $item) {
                    $date = \Carbon\Carbon::parse($item->date_submit)->format('d M Y');
                    $time = date("h:i A", strtotime($item->time)) . " - " . date("h:i A", strtotime($item->time_out));
                    $html .= "
                        <tr class='hover:bg-blue-50/50 transition-colors border-b border-slate-50 last:border-0'>
                            <td class='px-8 py-5 text-sm font-bold text-slate-800'>$date</td>
                            <td class='px-8 py-5'><span class='text-[10px] font-black px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full uppercase tracking-tighter'>{$item->selection}</span></td>
                            <td class='px-8 py-5 text-sm text-slate-600 font-semibold'><i class='fas fa-map-marker-alt text-red-400 mr-2'></i>{$item->location}</td>
                            <td class='px-8 py-5 text-sm text-slate-500'>$time</td>
                            <td class='px-8 py-5 text-xs text-slate-400 italic'>".($item->remarks ?: '-')."</td>
                        </tr>";
                }
                return $html;
            };
        @endphp

        <div x-cloak>
            {{-- SECTIONS GENERATOR --}}
            @foreach([
                ['badge' => 'Coming Soon', 'data' => $comingSoon, 'theme' => 'bg-blue-600'],
                ['badge' => 'Latest Record', 'data' => $currentYear, 'theme' => 'bg-navy-deep'],
                ['badge' => 'Archive History', 'data' => $pastRecords, 'theme' => 'bg-slate-400']
            ] as $section)
                
                @if($section['data']->count() > 0)
                    <div class="animate-reveal category-divider">
                        <span class="category-badge {{ $section['theme'] }}">{{ $section['badge'] }}</span>
                    </div>

                    <div x-show="currentView === 'card'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach($section['data'] as $item)
                        <div class="animate-reveal card-premium">
                            <div class="flex justify-between items-start mb-6">
                                <div class="bg-blue-50 px-4 py-2 rounded-2xl">
                                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ \Carbon\Carbon::parse($item->date_submit)->format('d M') }}</p>
                                    <p class="text-lg font-black text-blue-900 leading-none">{{ \Carbon\Carbon::parse($item->date_submit)->format('Y') }}</p>
                                </div>
                                <span class="bg-slate-900 text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-wider shadow-lg">{{ $item->selection }}</span>
                            </div>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-blue-500 text-xs">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <p class="text-sm font-bold text-slate-700">{{ date("h:i A", strtotime($item->time)) }} - {{ date("h:i A", strtotime($item->time_out)) }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-red-500 text-xs">
                                        <i class="fas fa-location-dot"></i>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-500">{{ $item->location }}</p>
                                </div>
                            </div>

                            <div class="bg-slate-50 rounded-2xl p-4">
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-tighter mb-1">Remarks</p>
                                <p class="text-xs text-slate-600 italic leading-relaxed">"{{ $item->remarks ?: 'No notes available.' }}"</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div x-show="currentView === 'list'" class="animate-reveal list-container mb-12">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 border-b border-slate-100">
                                    <tr>
                                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date Submitted</th>
                                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Purpose</th>
                                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Location</th>
                                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Time Allotted</th>
                                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>{!! $renderRows($section['data']) !!}</tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach

            @if($history->isEmpty())
                <div class="animate-reveal text-center py-32 bg-white rounded-[50px] shadow-inner border border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-folder-open text-slate-300 text-3xl"></i>
                    </div>
                    <p class="text-slate-400 font-black uppercase tracking-widest text-sm">No records found for 2027</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // REAL-TIME CLOCK
    function updateClock() {
        const now = new Date();
        const options = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };
        const dateStr = now.toLocaleDateString('en-GB', options);
        const timeStr = now.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById("clock").innerHTML = `<i class="far fa-calendar-alt text-blue-500"></i> ${dateStr} • ${timeStr}`;
    }
    updateClock(); 
    setInterval(updateClock, 1000);

    // GSAP ANIMATION
    window.addEventListener('DOMContentLoaded', () => {
        gsap.to(".animate-reveal", {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: "expo.out",
            delay: 0.2
        });
    });
</script>

</body>
</html>