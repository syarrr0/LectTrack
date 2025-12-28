<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Attendance History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            background-image: linear-gradient(rgba(240, 242, 245, 0.7), rgba(240, 242, 245, 0.7)), url('{{ asset("images/cg.jpg") }}');
            background-size: cover;
            background-attachment: scroll;
        }
        .header {
            position: fixed; top: 0; width: 100%;
            padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .main-content { padding-top: 100px; padding-bottom: 50px; }
        .history-card { transition: all 0.3s ease; contain: content; }
        .dropdown-menu {
            position: absolute; right: 0; top: 110%;
            background: white; border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 50; min-width: 160px; overflow: hidden;
        }
        /* Custom Pagination Styling */
        .pagination-container nav svg { width: 20px; }
        .pagination-container nav div:first-child { display: none; }
    </style>
</head>

<body x-data="{ 
    currentView: localStorage.getItem('viewPref') || 'card',
    setView(v) { this.currentView = v; localStorage.setItem('viewPref', v); }
}">

<div class="header">
    <a href="{{ route('lecturer.dashboard') }}" class="text-xl font-bold text-gray-800">LECTTRACK</a>
    <div class="flex items-center space-x-4">
        <div id="clock" class="hidden md:block text-sm text-gray-600 font-medium"></div>
        <button onclick="window.history.back()" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-black transition">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </button>
    </div>
</div>

<div class="main-content">
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">Attendance History</h1>
            <p class="text-gray-500">Track your check-in records and activity logs</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-blue-500">
                <p class="text-xs font-bold text-gray-400 uppercase">Total</p>
                <p class="text-2xl font-black">{{ $summary['totalRecords'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-green-500">
                <p class="text-xs font-bold text-gray-400 uppercase">Present</p>
                <p class="text-2xl font-black text-green-600">{{ $summary['hadir'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-yellow-500">
                <p class="text-xs font-bold text-gray-400 uppercase">Leave/MC</p>
                <p class="text-2xl font-black text-yellow-600">{{ $summary['cuti'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-purple-500">
                <p class="text-xs font-bold text-gray-400 uppercase">Official</p>
                <p class="text-2xl font-black text-purple-600">{{ $summary['mesyuarat'] }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm mb-6 flex flex-wrap gap-4 items-center">
            <form action="{{ route('attendance.history.search', $lecturer_id) }}" method="GET" class="flex flex-wrap gap-3 flex-grow">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search date, location..." 
                    class="flex-grow border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                
                <select name="reason" class="border border-gray-200 rounded-xl px-4 py-2 outline-none">
                    <option value="">All Status</option>
                    @foreach($availableReasons as $r)
                        <option value="{{ $r }}" {{ request('reason') == $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-700 transition">Filter</button>
                @if(request()->hasAny(['query', 'reason']))
                    <a href="{{ route('attendance.history', $lecturer_id) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300 transition flex items-center">Clear</a>
                @endif
            </form>

            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button @click="open = !open" class="bg-white border border-gray-200 px-4 py-2 rounded-xl flex items-center space-x-2">
                    <i :class="currentView === 'card' ? 'fas fa-grip-horizontal' : 'fas fa-list'"></i>
                    <span x-text="currentView === 'card' ? 'Card View' : 'List View'"></span>
                </button>
                <div class="dropdown-menu" x-show="open" x-cloak>
                    <button @click="setView('card'); open = false" class="hover:bg-gray-50 flex items-center"><i class="fas fa-grip-horizontal mr-2 text-gray-400"></i> Card View</button>
                    <button @click="setView('list'); open = false" class="hover:bg-gray-50 flex items-center"><i class="fas fa-list mr-2 text-gray-400"></i> List View</button>
                </div>
            </div>
        </div>

        <div x-cloak>
            <template x-if="currentView === 'card'">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($history as $item)
                        <div class="history-card bg-white p-6 rounded-2xl shadow-sm border-t-4 border-blue-500 hover:shadow-md">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-sm font-bold text-gray-400 uppercase">{{ \Carbon\Carbon::parse($item->date_submit)->format('d M Y') }}</span>
                                <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-[10px] font-black uppercase">{{ $item->selection }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-800"><i class="far fa-clock mr-2 text-blue-500"></i>{{ date("h:i A", strtotime($item->time)) }}</p>
                                <p class="text-sm text-gray-600 mt-1"><i class="fas fa-map-marker-alt mr-2 text-red-400"></i>{{ $item->location }}</p>
                            </div>
                            <div class="text-sm italic text-gray-400 border-t pt-3">
                                {{ $item->remarks ?: 'No remarks' }}
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white p-10 text-center rounded-2xl">No records found.</div>
                    @endforelse
                </div>
            </template>

            <template x-if="currentView === 'list'">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Location</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($history as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-bold">{{ \Carbon\Carbon::parse($item->date_submit)->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-gray-100 rounded text-[10px] font-bold">{{ $item->selection }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->location }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400 italic">{{ $item->remarks ?: '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </template>
        </div>



    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById("clock").innerHTML = now.toLocaleDateString('en-GB', { 
            weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' 
        }) + " | " + now.toLocaleTimeString();
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>

</body>
</html>