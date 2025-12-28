<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Performance Report | {{ $lecturer->nama }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        /* Base Styles */
        body { margin: 0; font-family: 'Inter', system-ui, sans-serif; background: #f1f5f9; color: #1f2937; padding-top: 84px; }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .card { background: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); padding: 30px; margin-bottom: 30px; }
        h1 { color: #0f172a; font-size: 28px; font-weight: 800; border-bottom: 3px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 25px; }

        /* Gaya Header */
        header { 
            position: fixed; 
            top: 0; 
            left: 0; 
            right: 0; 
            height: 64px; 
            background: linear-gradient(90deg, #0f172a, #1e293b); 
            color: white; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 32px; 
            box-shadow: 0 6px 18px rgba(0,0,0,0.3); 
            z-index: 100; 
        }

        /* HEADER BRAND (LOGO & TEXT) */
        .header-brand {
            display: flex; /* Untuk susun logo dan teks sebelah-menyebelah */
            align-items: center;
            gap: 15px;
        }

        /* LOGO IMAGE STYLE */
        .logo-img {
            height: 38px; /* Saiz logo */
            width: auto;
        }

        .header-brand h2 { 
            font-size: 20px; 
            font-weight: 700; 
            margin: 0; 
            color: #f8fafc; /* Warna teks */
        }

        /* ACTION BUTTONS (SIDE-BY-SIDE FIX) */
        .header-actions {
            display: flex; /* Paksa butang untuk duduk dalam satu baris */
            gap: 10px;    /* Jarak antara butang */
            align-items: center;
        }

        header button { 
            background: #2563eb; 
            border: none; 
            padding: 8px 18px; 
            border-radius: 10px; 
            color: white; 
            font-weight: 600; 
            cursor: pointer; 
            transition: 0.25s; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
        }
        header button:hover { 
            background: #1d4ed8; 
            transform: translateY(-1px); 
        }
        /* ... (Gaya CSS lain kekal sama) ... */
        
        /* Gaya Profile */
        .profile-card { display: flex; align-items: center; gap: 40px; }
        .profile-info { flex-grow: 1; }
        .profile-info h2 { font-size: 32px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 10px; }
        .profile-info p { margin: 5px 0; font-size: 16px; color: #475569; }
        .profile-info p strong { color: #1f2937; font-weight: 600; margin-right: 5px; }
        
        /* Gambar Profil */
        .profile-avatar { width: 120px; height: 120px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 50px; color: #2563eb; border: 4px solid #c7d2fe; flex-shrink: 0; overflow: hidden; }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        
        /* Gaya Grid Carta */
        .chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .chart-card h3 { font-size: 22px; color: #0f172a; margin-bottom: 20px; font-weight: 700; }

        /* Gaya Ringkasan Kehadiran */
        .summary-box { 
            background: #eef2ff; 
            padding: 20px; 
            border-radius: 12px; 
            margin-top: 20px; 
            border: 1px solid #c7d2fe;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .summary-item {
            padding: 10px 15px;
            border-right: 1px solid #d1d5db;
        }
        .summary-item:last-child {
            border-right: none;
        }

        .summary-value {
            font-size: 36px;
            font-weight: 800;
            color: #2563eb;
            line-height: 1;
        }

        .summary-label {
            font-size: 14px;
            color: #475569;
            margin-top: 5px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .profile-card { flex-direction: column; text-align: center; }
            .profile-avatar { margin-bottom: 20px; }
            .chart-grid { grid-template-columns: 1fr; }
            .summary-box { flex-direction: column; }
            .summary-item { border-right: none; border-bottom: 1px solid #d1d5db; }
            .summary-item:last-child { border-bottom: none; }
        }
    </style>
</head>
<body>

<header>
    {{-- HEADER BRAND BARU: Guna Gambar Logo --}}
    <div class="header-brand">
        {{-- Sila ganti 'logo-lecttrack.png' dengan nama fail logo sebenar anda dalam folder public/uploads/ --}}
        <img src="{{ asset('images/logo1_white.png') }}" alt="LectTrack Logo" class="logo-img">
        <h2>Lecturer's Report</h2>
    </div>
    
    {{-- ACTION BUTTONS: Telah dibetulkan untuk side-by-side --}}
    <div class="header-actions">
        <button onclick="window.location.href='{{ url('/admin/dashboard') }}'">
            <i class="fas fa-home"></i> Home
        </button>
        <button onclick="window.history.back()">
            <i class="fas fa-arrow-left"></i> Back
        </button>
    </div>
</header>

<div class="container">
    <h1>Performance & Status Report (Last {{ round($total_days_in_period/30.4, 0) }} Months)</h1>

    <div class="card profile-card">
        <div class="profile-avatar">
            @if($lecturer->image)
                {{-- MENGAMBIL GAMBAR DARI public/uploads/ --}}
                <img src="{{ asset('uploads/' . $lecturer->image) }}" alt="{{ $lecturer->nama }} Profile Image">
            @else
                {{-- Icon if no image is available --}}
                <i class="fas fa-user-tie"></i>
            @endif
        </div>
        <div class="profile-info">
            <h2>{{ $lecturer->nama }}</h2>
            <p><strong>Staff ID/Identity:</strong> {{ $lecturer->identity ?? '-' }}</p> 
            <p><strong>Department:</strong> {{ $lecturer->department }}</p>
            <p><strong>Email:</strong> {{ $lecturer->email ?? '-' }}</p>
            <p><strong>Contact:</strong> {{ $lecturer->phone ?? '-' }}</p>
        </div>
    </div>
    
    <div class="card summary-box">
        <div class="summary-item">
            <div class="summary-value">{{ $percentage_present }}%</div>
            <div class="summary-label">In-College Attendance (Excl. MC)</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $days_annual_leave }}</div>
            <div class="summary-label">Annual Leave Taken (Days)</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ round(($days_off_mc / $total_days_in_period) * 100, 1) }}%</div> 
            <div class="summary-label">Medical Leave (MC) Percentage</div>
        </div>
    </div>

    <div class="chart-grid">

        <div class="card chart-card">
            <h3>Status Distribution (Percentage of Days)</h3>
            <canvas id="statusPieChart"></canvas>
        </div>

        <div class="card chart-card">
            <h3>In-College Attendance vs. Leave Days</h3>
            <canvas id="attendanceBarChart"></canvas>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    
    // Data from Controller
    const statusPercentages = @json($statusPercentages);
    const percentagePresent = {{ $percentage_present }};
    const daysAnnualLeave = {{ $days_annual_leave }};
    const totalDaysInPeriod = {{ $total_days_in_period }};

    // =======================================================
    // 1. Pie Chart (Status Distribution)
    // =======================================================
    const pieCtx = document.getElementById('statusPieChart').getContext('2d');
    
    const originalLabels = Object.keys(statusPercentages);
    const pieData = Object.values(statusPercentages);

    // Translating labels for Pie Chart
    const translatedLabels = originalLabels.map(label => {
        switch(label) {
            case 'Di Kolej (In-College)': return 'In-College Duty';
            case 'PROGRAM': return 'Program / Events';
            case 'MESYUARAT': return 'Meetings';
            case 'CUTI(MC)': return 'Medical Leave (MC)';
            case 'KURSUS/BENGKEL': return 'Course/Workshop';
            case 'Cuti Tahunan (TIDAK DITEMUI DALAM DB)': return 'Annual Leave';
            case 'OTHERS': return 'Others / Uncategorised';
            default: return label;
        }
    });
    
    // Consistent colors for Status
    const pieColors = [
        '#2563eb', // In-College Duty
        '#f59e0b', // Program/Events
        '#10b981', // Meetings
        '#ef4444', // Medical Leave (MC)
        '#a855f7', // Course/Workshop
        '#6b7280', // Others
        '#f97316', // Annual Leave
    ];

    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: translatedLabels,
            datasets: [{
                label: 'Percentage of Days',
                data: pieData,
                backgroundColor: pieColors.slice(0, pieData.length),
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false,
                }
            }
        }
    });

    // =======================================================
    // 2. Bar Chart (Attendance vs Leave)
    // =======================================================
    const barCtx = document.getElementById('attendanceBarChart').getContext('2d');

    const attendanceDays = Math.round(percentagePresent * totalDaysInPeriod / 100);
    // Calculate total leave days (Annual Leave + MC Days)
    const totalLeaveDays = daysAnnualLeave + (statusPercentages['CUTI(MC)'] ? statusPercentages['CUTI(MC)'] * totalDaysInPeriod / 100 : 0); 

    const barData = {
        labels: ['In-College Days', 'Total Leave/MC Days'],
        datasets: [
            {
                label: 'Days',
                data: [attendanceDays, Math.round(totalLeaveDays)], 
                backgroundColor: ['#10b981', '#f97316'], 
                borderRadius: 4
            }
        ]
    };

    new Chart(barCtx, {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Days'
                    },
                    max: totalDaysInPeriod 
                }
            },
            plugins: {
                legend: {
                    display: false 
                },
                title: {
                    display: false,
                }
            }
        }
    });

});
</script>

</body>
</html>