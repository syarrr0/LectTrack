<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Attendance Report</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/report.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data for Summary Boxes (Counts)
        const TOTAL_LECTURERS = {{ $totalLecturers ?? 0 }}; // Total Lecturers
        const TOTAL_DUTY_TYPES = {{ $totalDutyTypes ?? 0 }}; // Total Unique Duty Types
        const TOTAL_RECORDS = {{ $totalRecords ?? 0 }}; // Total Attendance Records

        // Data for Line Chart (Monthly Records)
        const MONTHLY_RECORDS_DATA = @json(array_values($monthlyRecords ?? array_fill(1, 12, 0))); 

        // Data for Pie Charts (Percentages)
        const ACTIVE_PERCENT = {{ $activePercent ?? 0 }}; // Active/Course Duty Percent
        const OFFICIAL_PERCENT = {{ $officialPercent ?? 0 }}; // Official Duty/Meeting/Program Percent
        const LEAVE_PERCENT = {{ $leavePercent ?? 0 }}; // Leave/Sick/Others Duty Percent
    </script>
</head>
<body>

<div class="header">
    <div class="header-left">
        <i class="fas fa-chart-bar header-icon"></i>
        <h1>Attendance Analytics Dashboard</h1>
    </div>
    <div class="header-right">
        <div class="datetime" id="datetime"></div>
        <a href="{{ url('/admin/dashboard') }}" class="back-home-btn">
            <i class="fas fa-home"></i> Back to Home
        </a>
    </div>
</div>
<div class="container">

    <section class="summary-section">
        <div class="summary-box">
            <div class="icon-wrap bg-blue"><i class="fas fa-users"></i></div>
            <p>Total Registered Lecturers</p>
            <h2 id="countLecturers">0</h2>
            <span>Overall registered educators</span>
        </div>
        <div class="summary-box">
            <div class="icon-wrap bg-green"><i class="fas fa-tasks"></i></div>
            <p>Total Unique Duty Types</p>
            <h2 id="countDutyTypes">0</h2>
            <span>Total distinct attendance purposes recorded</span>
        </div>
        <div class="summary-box">
            <div class="icon-wrap bg-orange"><i class="fas fa-clipboard-check"></i></div>
            <p>Total Attendance Records</p>
            <h2 id="countAttendance">0</h2>
            <span>Cumulative attendance entries in DB</span>
        </div>
    </section>

    <section class="chart-section line-chart-card">
        <h3><i class="fas fa-chart-line"></i> Monthly Attendance Trend</h3>
        <p class="chart-desc">This graph shows the total attendance records submitted by month this year.</p>
        <canvas id="lineChart"></canvas>
    </section>

    <section class="pie-section">
        <div class="pie-card">
            <h4><i class="fas fa-check-circle text-green"></i> Active Duty Rate</h4>
            <div class="chart-container">
                <canvas id="pieActive"></canvas>
                <div class="chart-center-text" id="activeRateText">0%</div>
            </div>
            <p class="chart-desc">In-College / Course / Workshop</p>
        </div>
        <div class="pie-card">
            <h4><i class="fas fa-clock text-blue"></i> Official Duty Rate</h4>
            <div class="chart-container">
                <canvas id="pieOfficial"></canvas>
                <div class="chart-center-text" id="officialRateText">0%</div>
            </div>
            <p class="chart-desc">Meeting / Program Attendance</p>
        </div>
        <div class="pie-card">
            <h4><i class="fas fa-times-circle text-red"></i> Leave Rate</h4>
            <div class="chart-container">
                <canvas id="pieLeave"></canvas>
                <div class="chart-center-text" id="leaveRateText">0%</div>
            </div>
            <p class="chart-desc">Medical / Other Leave</p>
        </div>
    </section>

</div>

<footer>
    © 2025 LectTrack • Smart Attendance System
</footer>

<script>
    /* REAL TIME DATE & TIME */
    function updateDateTime() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        document.getElementById('datetime').innerText = now.toLocaleString('en-MY', options);
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();

    /* ANIMATED COUNTERS */
    function animateCounter(id, target) {
        let count = 0;
        const speed = target / 80;
        const interval = setInterval(() => {
            count += speed;
            if (count >= target) {
                count = target;
                clearInterval(interval);
            }
            document.getElementById(id).innerText = Math.floor(count).toLocaleString(); 
        }, 25);
    }

    animateCounter('countLecturers', TOTAL_LECTURERS);
    animateCounter('countDutyTypes', TOTAL_DUTY_TYPES);
    animateCounter('countAttendance', TOTAL_RECORDS);

    /* LINE CHART */
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Attendance Records',
                data: MONTHLY_RECORDS_DATA, 
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)', 
                tension: 0.4, 
                pointRadius: 5,
                pointBackgroundColor: '#2563eb',
                pointHoverRadius: 7,
                fill: true 
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: { 
                y: { 
                    beginAtZero: true,
                    suggestedMax: Math.max(...MONTHLY_RECORDS_DATA) * 1.2 || 10,
                    grid: { color: '#e5e7eb' }
                },
                x: {
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
                labels: ['Rate','Remaining'],
                datasets: [{
                    data: [value, 100 - value],
                    backgroundColor: [color, '#e5e7eb'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '85%', 
                plugins: { legend: { display: false } },
                animation: { animateScale: true, duration: 1600 },
                events: [] 
            }
        });
        document.getElementById(centerTextId).innerText = value + '%'; // Update center text
    }

    createPie('pieActive', ACTIVE_PERCENT, '#22c55e', 'activeRateText'); 
    createPie('pieOfficial', OFFICIAL_PERCENT, '#2563eb', 'officialRateText'); 
    createPie('pieLeave', LEAVE_PERCENT, '#ef4444', 'leaveRateText'); 
</script>

</body>
</html>