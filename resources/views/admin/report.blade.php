<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Attendance Analytics</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px -10px rgba(37, 99, 235, 0.15);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Pulse Animation for Live Time */
        .pulse-dot {
            height: 8px;
            width: 8px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 0 rgba(34, 197, 94, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        canvas {
            filter: drop-shadow(0px 10px 10px rgba(0, 0, 0, 0.02));
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    <script>
        // Keep original functional data
        const TOTAL_LECTURERS = {{ $totalLecturers ?? 0 }};
        const TOTAL_DUTY_TYPES = {{ $totalDutyTypes ?? 0 }};
        const TOTAL_RECORDS = {{ $totalRecords ?? 0 }};
        const MONTHLY_RECORDS_DATA = @json(array_values($monthlyRecords ?? array_fill(1, 12, 0))); 
        const ACTIVE_PERCENT = {{ $activePercent ?? 0 }};
        const OFFICIAL_PERCENT = {{ $officialPercent ?? 0 }};
        const LEAVE_PERCENT = {{ $leavePercent ?? 0 }};
    </script>
</head>
<body class="min-h-screen">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3" id="header-logo">
                <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-200">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-800 uppercase">Attendance Analytics</h1>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-widest">Dashboard Overview</p>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="hidden lg:flex flex-col items-end">
                    <div class="flex items-center text-sm font-semibold text-slate-600">
                        <span class="pulse-dot"></span>
                        <span id="datetime"></span>
                    </div>
                </div>
                <a href="{{ url('/admin/dashboard') }}" class="group flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-full text-sm font-bold transition-all hover:bg-blue-600 hover:shadow-xl hover:shadow-blue-200 active:scale-95">
                    <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="glass-card rounded-3xl p-8 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full transition-transform group-hover:scale-150"></div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Lecturers</p>
                        <h2 class="text-4xl font-extrabold text-slate-800 mt-1" id="countLecturers">0</h2>
                    </div>
                    <div class="text-xs font-medium text-slate-400">Overall registered educators</div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-8 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full transition-transform group-hover:scale-150"></div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                        <i class="fas fa-layer-group text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Duty Types</p>
                        <h2 class="text-4xl font-extrabold text-slate-800 mt-1" id="countDutyTypes">0</h2>
                    </div>
                    <div class="text-xs font-medium text-slate-400">Total distinct purposes</div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-8 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full transition-transform group-hover:scale-150"></div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-600">
                        <i class="fas fa-file-signature text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Records</p>
                        <h2 class="text-4xl font-extrabold text-slate-800 mt-1" id="countAttendance">0</h2>
                    </div>
                    <div class="text-xs font-medium text-slate-400">Database entries recorded</div>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] p-8 mb-10" data-aos="zoom-in">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Monthly Attendance Trend</h3>
                    <p class="text-slate-500 text-sm">Real-time data synchronization with database entries.</p>
                </div>
                <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest">
                    Year 2025
                </div>
            </div>
            <div class="h-[400px]">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card rounded-[2rem] p-8 flex flex-col items-center text-center" data-aos="fade-right">
                <h4 class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-6">Active Duty Rate</h4>
                <div class="relative w-48 h-48 mb-6">
                    <canvas id="pieActive"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-3xl font-black text-slate-800" id="activeRateText">0%</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase">In-College / Workshop</p>
            </div>

            <div class="glass-card rounded-[2rem] p-8 flex flex-col items-center text-center" data-aos="fade-up">
                <h4 class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-6">Official Duty Rate</h4>
                <div class="relative w-48 h-48 mb-6">
                    <canvas id="pieOfficial"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-3xl font-black text-slate-800" id="officialRateText">0%</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase">Meeting / Program</p>
            </div>

            <div class="glass-card rounded-[2rem] p-8 flex flex-col items-center text-center" data-aos="fade-left">
                <h4 class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-6">Leave Rate</h4>
                <div class="relative w-48 h-48 mb-6">
                    <canvas id="pieLeave"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-3xl font-black text-slate-800" id="leaveRateText">0%</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-rose-600 bg-rose-50 px-3 py-1 rounded-full uppercase">Medical / Other Leave</p>
            </div>
        </div>

    </main>

    <footer class="text-center py-10 text-slate-400 text-sm font-medium">
        <div class="flex items-center justify-center gap-2 mb-2 text-slate-800 font-bold">
            <i class="fas fa-shield-halved text-blue-600"></i> LectTrack
        </div>
        &copy; 2025 Smart Attendance System • Built for Excellence
    </footer>

    <script>
        // Initialization
        AOS.init({ duration: 1000, once: true });

        // Header Entrance Animation
        gsap.from("#header-logo", { opacity: 0, x: -30, duration: 1, ease: "power4.out" });

        /* REAL TIME DATE & TIME */
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            document.getElementById('datetime').innerText = now.toLocaleString('en-MY', options);
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();

        /* ANIMATED COUNTERS */
        function animateCounter(id, target) {
            let count = 0;
            const speed = target / 60;
            const interval = setInterval(() => {
                count += speed;
                if (count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                document.getElementById(id).innerText = Math.floor(count).toLocaleString(); 
            }, 30);
        }

        animateCounter('countLecturers', TOTAL_LECTURERS);
        animateCounter('countDutyTypes', TOTAL_DUTY_TYPES);
        animateCounter('countAttendance', TOTAL_RECORDS);

        /* LINE CHART */
        const ctxLine = document.getElementById('lineChart');
        const gradient = ctxLine.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Attendance Records',
                    data: MONTHLY_RECORDS_DATA, 
                    borderColor: '#2563eb',
                    borderWidth: 4,
                    backgroundColor: gradient, 
                    tension: 0.45, 
                    pointRadius: 0,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#2563eb',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3,
                    fill: true 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        cornerRadius: 10,
                        displayColors: false
                    }
                },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        ticks: { color: '#94a3b8', font: { weight: '600' } },
                        grid: { color: '#f1f5f9' }
                    },
                    x: {
                        ticks: { color: '#94a3b8', font: { weight: '600' } },
                        grid: { display: false }
                    }
                }
            }
        });

        /* PIE CHARTS */
        function createPie(id, value, color, centerTextId) {
            new Chart(document.getElementById(id), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [value, 100 - value],
                        backgroundColor: [color, '#f1f5f9'],
                        borderWidth: 0,
                        hoverOffset: 0
                    }]
                },
                options: {
                    cutout: '82%', 
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    animation: { animateScale: true, duration: 2000 },
                    events: [] 
                }
            });
            document.getElementById(centerTextId).innerText = value + '%';
        }

        createPie('pieActive', ACTIVE_PERCENT, '#10b981', 'activeRateText'); 
        createPie('pieOfficial', OFFICIAL_PERCENT, '#3b82f6', 'officialRateText'); 
        createPie('pieLeave', LEAVE_PERCENT, '#f43f5e', 'leaveRateText'); 
    </script>

</body>
</html>