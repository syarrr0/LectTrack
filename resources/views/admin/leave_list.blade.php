<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Staff On Leave</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #fff7ed; } /* Warna oren cair */
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="antialiased">

    <header class="bg-orange-600 text-white sticky top-0 z-50 no-print shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-white/20 rounded-lg">
                    <i data-lucide="calendar-off" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-tight leading-none uppercase">Staff On Leave</h1>
                    <p class="text-[10px] text-orange-200 font-bold uppercase tracking-widest mt-1">MC / CRK / CTR Tracker</p>
                </div>
            </div>

            <div class="relative w-full md:w-96 no-print">
                <input type="text" id="searchInput" placeholder="Search name or department..." 
                    class="block w-full pl-10 pr-4 py-2.5 bg-orange-700/50 border border-orange-400/30 rounded-xl text-sm text-white placeholder-orange-200 focus:outline-none focus:ring-2 focus:ring-white/50">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-orange-200">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm font-bold bg-white text-orange-600 px-4 py-2.5 rounded-xl hover:bg-orange-50 transition-all shadow-md">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8">
        <div id="resultsContainer">
            @php $globalIndex = 1; @endphp

            @forelse($lecturersOnLeave as $jabatan => $staffs)
            <div class="dept-group mb-6" data-dept="{{ strtoupper($jabatan) }}">
                <div class="bg-white rounded-2xl shadow-sm border border-orange-100 overflow-hidden">
                    <div class="bg-orange-50 border-b border-orange-100 px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="p-1.5 bg-orange-100 text-orange-600 rounded-md"><i data-lucide="folder-tree" class="w-4 h-4"></i></span>
                            <h2 class="font-extrabold text-slate-800 text-sm uppercase tracking-wider">{{ $jabatan ?: 'STAF UMUM' }}</h2>
                        </div>
                        <span class="text-[10px] font-black bg-orange-500 text-white px-3 py-1 rounded-full uppercase">{{ count($staffs) }} On Leave</span>
                    </div>

                    <div class="grid grid-cols-1 divide-y divide-slate-50">
                        @foreach($staffs as $lecturer)
                        <div class="staff-row group flex items-center justify-between px-6 py-4 hover:bg-orange-50/50 transition-all" data-name="{{ strtoupper($lecturer->nama) }}">
                            <div class="flex items-center gap-4">
                                <span class="text-xs font-bold text-slate-300 w-6">{{ $globalIndex++ }}</span>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700 uppercase group-hover:text-orange-600 transition-colors">{{ $lecturer->nama }}</span>
                                    </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black bg-red-50 text-red-600 border border-red-100 uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Currently Away
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-20 bg-white rounded-3xl border border-orange-100">
                <i data-lucide="smile" class="w-16 h-16 text-orange-200 mx-auto mb-4"></i>
                <h3 class="text-slate-800 font-bold">Good News!</h3>
                <p class="text-slate-400 text-sm">No lecturers are on leave today.</p>
            </div>
            @endforelse
        </div>
    </main>

    <script>
        lucide.createIcons();
        // Live Search Logic (Sama macam in_college_list)
        const searchInput = document.getElementById('searchInput');
        const deptGroups = document.querySelectorAll('.dept-group');
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toUpperCase();
            deptGroups.forEach(group => {
                const deptName = group.getAttribute('data-dept');
                const staffRows = group.querySelectorAll('.staff-row');
                let hasMatch = false;
                staffRows.forEach(row => {
                    if (row.getAttribute('data-name').includes(term) || deptName.includes(term)) {
                        row.style.display = 'flex'; hasMatch = true;
                    } else { row.style.display = 'none'; }
                });
                group.style.display = hasMatch ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>