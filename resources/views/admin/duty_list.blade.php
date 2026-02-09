<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Official Duty Today</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f5f3ff; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="antialiased">

    <header class="bg-indigo-900 text-white sticky top-0 z-50 no-print shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-indigo-500 rounded-xl shadow-lg">
                    <i data-lucide="briefcase" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-tight uppercase leading-none">Official Duty</h1>
                    <p class="text-[10px] text-indigo-300 font-bold uppercase tracking-widest mt-1">Institutional Task Tracker</p>
                </div>
            </div>

            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-indigo-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Search name or department..." 
                    class="block w-full pl-10 pr-4 py-2.5 bg-indigo-800 border border-indigo-700 rounded-xl text-sm text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition-all">
            </div>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm font-bold bg-white text-indigo-900 px-5 py-2.5 rounded-xl hover:bg-indigo-50 transition-all shadow-lg">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-10">
        <div id="resultsContainer">
            @php $globalIndex = 1; @endphp

            @forelse($lecturersOnDuty as $jabatan => $staffs)
            <div class="dept-group mb-8" data-dept="{{ strtoupper($jabatan) }}">
                <div class="bg-white rounded-3xl shadow-sm border border-indigo-100 overflow-hidden">
                    
                    <div class="bg-indigo-50/50 border-b border-indigo-100 px-8 py-5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                            <h2 class="font-extrabold text-slate-800 text-sm uppercase tracking-widest">
                                {{ $jabatan ?: 'STAF UMUM' }}
                            </h2>
                        </div>
                        <span class="text-[10px] font-black bg-indigo-600 text-white px-4 py-1.5 rounded-full uppercase tracking-tighter">
                            {{ count($staffs) }} Personnel
                        </span>
                    </div>

                   <div class="divide-y divide-slate-50">
    @foreach($staffs as $lecturer)
    <div class="staff-row group flex items-center justify-between px-8 py-5 hover:bg-indigo-50/30 transition-all" data-name="{{ strtoupper($lecturer?->nama) }}">
        
        <div class="flex items-center gap-6">
            <span class="text-xs font-black text-slate-300 w-4">{{ $globalIndex++ }}</span>
            
            <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors uppercase tracking-tight">
                {{ $lecturer?->nama ?? 'NAMA TIDAK DIJUMPAI' }}
            </span>
        </div>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase tracking-tighter">
            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
            Out on Duty
        </span>

    </div>
    @endforeach
</div>
                </div>
            </div>
            @empty
            <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-indigo-100">
                <i data-lucide="briefcase" class="w-16 h-16 text-indigo-100 mx-auto mb-4"></i>
                <h3 class="text-slate-800 font-black text-xl uppercase tracking-tight">No Official Duties</h3>
                <p class="text-slate-400 text-sm mt-2">All lecturers are currently present in college.</p>
            </div>
            @endforelse
        </div>

        <div id="noResults" class="hidden text-center py-20">
            <i data-lucide="search-x" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
            <h3 class="text-slate-800 font-bold uppercase tracking-tight">No Match Found</h3>
            <p class="text-slate-400 text-sm">Carian tidak menjumpai mana-mana staf atau jabatan.</p>
        </div>
    </main>

    <script>
        lucide.createIcons();

        // Search Logic
        const searchInput = document.getElementById('searchInput');
        const deptGroups = document.querySelectorAll('.dept-group');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toUpperCase();
            let totalMatch = 0;

            deptGroups.forEach(group => {
                const deptName = group.getAttribute('data-dept');
                const staffRows = group.querySelectorAll('.staff-row');
                let hasDeptMatch = false;

                staffRows.forEach(row => {
                    const staffName = row.getAttribute('data-name');
                    if (staffName.includes(term) || deptName.includes(term)) {
                        row.style.display = 'flex';
                        hasDeptMatch = true;
                        totalMatch++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                group.style.display = hasDeptMatch ? 'block' : 'none';
            });

            noResults.classList.toggle('hidden', totalMatch > 0);
        });
    </script>
</body>
</html>