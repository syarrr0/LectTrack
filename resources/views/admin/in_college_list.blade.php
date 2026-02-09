<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Staff Presence</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        .search-focus:focus-within { ring: 2px solid #3b82f6; border-color: transparent; }
        .dept-container:last-child { margin-bottom: 2rem; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="antialiased">

    <header class="bg-slate-900 text-white sticky top-0 z-50 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-blue-500 rounded-lg shadow-lg">
                    <i data-lucide="building-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-tight leading-none uppercase">Staff Presence</h1>
                    <p class="text-[10px] text-blue-300 font-bold uppercase tracking-widest mt-1">Institutional Live Tracker</p>
                </div>
            </div>

            <div class="relative w-full md:w-96 no-print">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="searchInput" 
                    placeholder="Search name or department..." 
                    class="block w-full pl-10 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-400 focus:outline-none transition-all">
            </div>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm font-bold bg-white/10 hover:bg-white/20 px-4 py-2.5 rounded-xl transition-all border border-white/10 no-print">
                <i data-lucide="layout-dashboard" class="w-4 h-4 text-blue-400"></i> Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8">
        
        <div id="resultsContainer">
            @php $globalIndex = 1; @endphp

            @forelse($lecturersInCollege as $jabatan => $staffs)
            <div class="dept-group mb-6" data-dept="{{ strtoupper($jabatan) }}">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    
                    <div class="bg-slate-50 border-b border-slate-100 px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="p-1.5 bg-blue-100 text-blue-600 rounded-md">
                                <i data-lucide="folder-tree" class="w-4 h-4"></i>
                            </span>
                            <h2 class="font-extrabold text-slate-800 text-sm uppercase tracking-wider">
                                {{ $jabatan ?: 'STAF UMUM / TIADA JABATAN' }}
                            </h2>
                        </div>
                        <span class="text-[10px] font-black bg-blue-600 text-white px-3 py-1 rounded-full uppercase">
                            {{ count($staffs) }} Active
                        </span>
                    </div>

                    <div class="grid grid-cols-1 divide-y divide-slate-50">
                        @foreach($staffs as $lecturer)
                        <div class="staff-row group flex items-center justify-between px-6 py-4 hover:bg-blue-50/50 transition-all" data-name="{{ strtoupper($lecturer->nama) }}">
                            <div class="flex items-center gap-4">
                                <span class="text-xs font-bold text-slate-300 w-6">{{ $globalIndex++ }}</span>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700 uppercase tracking-tight group-hover:text-blue-600 transition-colors">
                                        {{ $lecturer->nama }}
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter md:hidden">
                                        {{ $jabatan }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black bg-green-50 text-green-600 border border-green-100 uppercase">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]"></span>
                                    Campus
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-20">
                <div class="bg-white p-10 rounded-3xl shadow-sm inline-block border border-slate-200">
                    <i data-lucide="user-x" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
                    <p class="text-slate-400 font-bold uppercase text-xs tracking-widest">No Lecturers Found</p>
                </div>
            </div>
            @endforelse
        </div>

        <div id="noResults" class="hidden text-center py-20">
            <i data-lucide="search-x" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
            <h3 class="text-slate-800 font-bold">No results match your search</h3>
            <p class="text-slate-400 text-sm">Try searching with a different name or department.</p>
        </div>

    </main>

    <footer class="max-w-7xl mx-auto px-8 pb-10 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] flex justify-between items-center">
        <p>LectTrack Institutional System &copy; 2026</p>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Server Live
        </div>
    </footer>

    <script>
        // Initialize Icons
        lucide.createIcons();

        // SEARCH FUNCTIONALITY
        const searchInput = document.getElementById('searchInput');
        const deptGroups = document.querySelectorAll('.dept-group');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toUpperCase();
            let totalVisible = 0;

            deptGroups.forEach(group => {
                const deptName = group.getAttribute('data-dept');
                const staffRows = group.querySelectorAll('.staff-row');
                let hasMatchInDept = false;

                // Tapis staf dalam jabatan
                staffRows.forEach(row => {
                    const staffName = row.getAttribute('data-name');
                    if (staffName.includes(term) || deptName.includes(term)) {
                        row.style.display = 'flex';
                        hasMatchInDept = true;
                        totalVisible++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Kalau jabatan atau ada staf yang match, tunjuk group tu
                if (hasMatchInDept) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            });

            // Tunjuk mesej "No Results" kalau takda apa-apa yang match
            if (totalVisible === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });
    </script>
</body>
</html>