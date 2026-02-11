<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Analytics Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Data asal dikekalkan tanpa perubahan fungsi
        const TOTAL_LECTURERS = {{ $totalLecturers ?? 0 }};
        const TOTAL_DUTY_TYPES = {{ $totalDutyTypes ?? 0 }};
        const TOTAL_RECORDS = {{ $totalRecords ?? 0 }};
        const MONTHLY_RECORDS_DATA = @json(array_values($monthlyRecords ?? array_fill(1, 12, 0))); 
        const ACTIVE_PERCENT = {{ $activePercent ?? 0 }};
        const OFFICIAL_PERCENT = {{ $officialPercent ?? 0 }};
        const LEAVE_PERCENT = {{ $leavePercent ?? 0 }};
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f4f8;
            color: #0f172a;
        }

        /* Blue Theme Background */
        .bg-pattern {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 0% 0%, #e0f2fe 0%, #f0f9ff 100%);
            overflow: hidden;
        }

        .blue-blob {
            position: absolute;
            width: 500px; height: 500px;
            background: rgba(37, 99, 235, 0.05);
            filter: blur(80px);
            border-radius: 50%;
        }

        /* Premium Blue Card */
        .card-blue {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #dbeafe;
            box-shadow: 0 4px 20px -2px rgba(37, 99, 235, 0.08);
            transition: all 0.3s ease;
        }

        .card-blue:hover {
            border-color: #3b82f6;
            box-shadow: 0 10px 30px -5px rgba(37, 99, 235, 0.15);
        }

        .summary-icon {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 8px 16px -4px rgba(37, 99, 235, 0.3);
        }

        /* Scrollbar Biru */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen pb-12">

    <div class="bg-pattern">
        <div class="blue-blob -top-24 -left-24"></div>
        <div class="blue-blob top-1/2 -right-24" style="background: rgba(29, 78, 216, 0.03);"></div>
    </div>

    <header class="max-w-7xl mx-auto px-6 pt-8 pb-4 flex flex-col md:flex-row justify-between items-center gap-6" id="header">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 summary-icon rounded-2xl flex items-center justify-center text-white text-2xl">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900 tracking-tight">LectTrack <span class="text-blue-600">Analytics</span></h1>
                <p class="text-blue-500 font-medium text-sm flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    Smart Monitoring Dashboard
                </p>
            </div>
        </div>
        
        <div class="flex items-center gap-4 bg-white p-2 rounded-2xl border border-blue-100 shadow-sm">
            <div class="px-4 py-2">
                <p class="text-[10px] uppercase font-bold text-blue-400 tracking-widest leading-none">Server Time</p>
                <span id="datetime" class="text-sm font-bold text-blue-900"></span>
            </div>
            <a href="{{ url('/admin/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-200 flex items-center gap-2 active:scale-95">
                <i class="fas fa-house"></i> Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 mt-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="card-blue rounded-[2rem] p-8 group overflow-hidden relative" data-aos="fade-up">
                <div class="relative z-10">
                    <div class="text-blue-500 text-sm font-bold uppercase tracking-widest mb-2">Total Staff</div>
                    <div class="text-5xl font-black text-blue-900 flex items-baseline gap-2">
                        <span id="countLecturers">0</span>
                    </div>
                    <p class="mt-4 text-slate-500 text-sm font-medium">Registered lecturers in system</p>
                </div>
                <i class="fas fa-users absolute -bottom-4 -right-4 text-8xl text-blue-50 opacity-[0.05] group-hover:scale-110 transition-transform"></i>
            </div>

            <div class="card-blue rounded-[2rem] p-8 group overflow-hidden relative" data-aos="fade-up" data-aos-delay="100">
                <div class="relative z-10">
                    <div class="text-blue-500 text-sm font-bold uppercase tracking-widest mb-2">Activities</div>
                    <div class="text-5xl font-black text-blue-900 flex items-baseline gap-2">
                        <span id="countDutyTypes">0</span>
                    </div>
                    <p class="mt-4 text-slate-500 text-sm font-medium">Unique duty categories</p>
                </div>
                <i class="fas fa-briefcase absolute -bottom-4 -right-4 text-8xl text-blue-50 opacity-[0.05] group-hover:scale-110 transition-transform"></i>
            </div>

            <div class="card-blue rounded-[2rem] p-8 group overflow-hidden relative" data-aos="fade-up" data-aos-delay="200">
                <div class="relative z-10">
                    <div class="text-blue-500 text-sm font-bold uppercase tracking-widest mb-2">Submissions</div>
                    <div class="text-5xl font-black text-blue-900 flex items-baseline gap-2">
                        <span id="countAttendance">0</span>
                    </div>
                    <p class="mt-4 text-slate-500 text-sm font-medium">Total entries recorded</p>
                </div>
                <i class="fas fa-check-double absolute -bottom-4 -right-4 text-8xl text-blue-50 opacity-[0.05] group-hover:scale-110 transition-transform"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <div class="lg:col-span-2 card-blue rounded-[2.5rem] p-10" data-aos="fade-right">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h2 class="text-2xl font-extrabold text-blue-900">Attendance Trend</h2>
                        <p class="text-slate-500 font-medium">Monthly submission analysis</p>
                    </div>
                    <div class="bg-blue-50 px-4 py-2 rounded-xl text-blue-600 font-bold text-xs">2026 DATA</div>
                </div>
                <div class="h-[350px]">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            <div class="card-blue rounded-[2.5rem] p-8 flex flex-col gap-6" data-aos="fade-left">
                <h3 class="text-xl font-bold text-blue-900 px-2">Live Percentage</h3>
                
                <div class="flex items-center gap-5 p-4 rounded-3xl bg-blue-50/50">
                    <div class="w-20 h-20 relative flex-shrink-0">
                        <canvas id="pieActive"></canvas>
                        <div class="absolute inset-0 flex items-center justify-center text-xs font-black text-blue-900" id="activeRateText">0%</div>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-blue-900 leading-tight">Active Duty</div>
                        <div class="text-[10px] text-blue-500 font-bold uppercase">Workshops & Course</div>
                    </div>
                </div>

                <div class="flex items-center gap-5 p-4 rounded-3xl bg-blue-50/50">
                    <div class="w-20 h-20 relative flex-shrink-0">
                        <canvas id="pieOfficial"></canvas>
                        <div class="absolute inset-0 flex items-center justify-center text-xs font-black text-blue-900" id="officialRateText">0%</div>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-blue-900 leading-tight">Official Duty</div>
                        <div class="text-[10px] text-blue-500 font-bold uppercase">Meetings & Programs</div>
                    </div>
                </div>

                <div class="flex items-center gap-5 p-4 rounded-3xl bg-rose-50/50">
                    <div class="w-20 h-20 relative flex-shrink-0">
                        <canvas id="pieLeave"></canvas>
                        <div class="absolute inset-0 flex items-center justify-center text-xs font-black text-rose-900" id="leaveRateText">0%</div>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-rose-900 leading-tight">Leave Rate</div>
                        <div class="text-[10px] text-rose-500 font-bold uppercase">Sick / Medical Leave</div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center mt-12">
        <div class="inline-flex items-center gap-2 text-blue-900 font-extrabold uppercase tracking-widest text-xs bg-white px-6 py-3 rounded-full shadow-sm border border-blue-50">
            <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
            LectTrack © 2026
        </div>
    </footer>

    <script>
        AOS.init({ duration: 800, once: true });

        // Entrance Animation
        gsap.from("#header", { y: -50, opacity: 0, duration: 1, ease: "back.out" });

        /* DATE & TIME */
        function updateDateTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true, day: 'numeric', month: 'short' };
            document.getElementById('datetime').innerText = now.toLocaleString('en-MY', options);
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();

        /* COUNTER ANIMATION */
        function animateCounter(id, target) {
            let count = 0;
            const step = target / 50;
            const inv = setInterval(() => {
                count += step;
                if (count >= target) {
                    count = target;
                    clearInterval(inv);
                }
                document.getElementById(id).innerText = Math.floor(count).toLocaleString();
            }, 20);
        }

        animateCounter('countLecturers', TOTAL_LECTURERS);
        animateCounter('countDutyTypes', TOTAL_DUTY_TYPES);
        animateCounter('countAttendance', TOTAL_RECORDS);

        /* LINE CHART CONFIG */
        const ctx = document.getElementById('lineChart').getContext('2d');
        const blueGrad = ctx.createLinearGradient(0, 0, 0, 350);
        blueGrad.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
        blueGrad.addColorStop(1, 'rgba(37, 99, 235, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Records',
                    data: MONTHLY_RECORDS_DATA,
                    borderColor: '#2563eb',
                    borderWidth: 4,
                    backgroundColor: blueGrad,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' }, border: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        /* PIE CHARTS CONFIG */
        function createPie(id, val, color, textId) {
            new Chart(document.getElementById(id), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [val, 100 - val],
                        backgroundColor: [color, '#e2e8f0'],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '75%',
                    plugins: { tooltip: { enabled: false } },
                    animation: { duration: 2000, easing: 'easeOutQuart' }
                }
            });
            document.getElementById(textId).innerText = val + '%';
        }

        createPie('pieActive', ACTIVE_PERCENT, '#2563eb', 'activeRateText'); 
        createPie('pieOfficial', OFFICIAL_PERCENT, '#3b82f6', 'officialRateText'); 
        createPie('pieLeave', LEAVE_PERCENT, '#f43f5e', 'leaveRateText'); 
    </script>
</body>
</html>