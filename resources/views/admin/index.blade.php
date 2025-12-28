<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Lecturer List</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background: #f1f5f9;
            color: #1f2937;
        }

        /* ================= HEADER ================= */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: linear-gradient(90deg, #0f172a, #1e293b); /* Hitam Gelap */
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.3);
            z-index: 100;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-brand i {
            font-size: 24px;
            color: #2563eb; 
        }

        header h2 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
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

        /* ================= CONTAINER ================= */
        .table-container {
            margin: 100px auto 40px; 
            max-width: 1200px; 
            background: linear-gradient(180deg, #ffffff, #f8fafc);
            border-radius: 22px;
            padding: 30px; 
            box-shadow:
                0 25px 50px rgba(0,0,0,0.08),
                inset 0 1px 0 rgba(255,255,255,0.7);
            animation: fadeSlide 0.8s ease;
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ================= TABLE HEADER ================= */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end; 
            margin-bottom: 25px; 
            gap: 20px;
        }

        .table-title {
            font-size: 26px; 
            font-weight: 800; 
            color: #0f172a;
        }

        /* ===== STAT CARD & SEARCH ===== */
        .counter-card {
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            padding: 10px 18px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            color: #1e3a8a;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .counter-card span {
            background: #2563eb;
            color: white;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }
        
        .search-box { position: relative; }
        .search-box input {
            padding: 12px 44px 12px 18px;
            width: 300px; 
            border-radius: 999px;
            border: 1px solid #d1d5db;
            outline: none;
            font-size: 14px;
            background: white;
            transition: 0.25s;
        }
        .search-box::after {
            content: "🔍";
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            opacity: 0.6;
        }

        /* ================= TABLE STRUCTURE ================= */
        table {
            width: 100%;
            border-collapse: separate; 
            border-spacing: 0 8px; 
            font-size: 15px;
        }

        thead th {
            padding: 14px 18px;
            background: #eef2ff; 
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
            font-weight: 700; 
            color: #475569;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 16px 18px; 
            border-bottom: 1px solid #e5e7eb;
            background: #ffffff; 
        }

        tbody tr:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.08); 
            transform: scale(1.005);
            background: #f8fafc;
        }

        /* ================= STATUS & ACTION WRAPPER ================= */
        .status-cell {
            /* Flex column untuk susun status di atas butang action */
            display: flex;
            flex-direction: column;
            gap: 8px; 
            align-items: flex-start;
        }
        
        /* New: Button group wrapper for the two new buttons */
        .action-button-group {
            display: flex;
            gap: 8px; /* Jarak antara butang */
            margin-top: 5px; /* Jarak dari status label */
        }



        /* ================= DIRECT ACTION BUTTONS (NEW STYLE) ================= */
        .action-button {
            /* Gaya butang sama seperti header: Hitam Gelap */
            background: #0f172a; 
            color: white;
            border: none;
            padding: 6px 10px; /* Lebih kecil dan padat */
            border-radius: 6px; 
            font-size: 12px; 
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none; /* Untuk pautan <a> */
            white-space: nowrap;
        }
        
        /* Warna Report (Blue Accent) */
        .action-button.report {
            background: #2563eb;
        }
        
        .action-button:hover {
            background: #1e293b; 
            transform: translateY(-1px);
        }
        .action-button.report:hover {
            background: #1d4ed8; 
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 900px) {
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .search-box input {
                width: 100%;
            }
            header {
                padding: 0 20px;
            }
            /* Stack buttons on small screens if necessary, though 2 should fit */
            .action-button-group {
                flex-direction: column;
                gap: 5px;
            }
            .action-button {
                width: 100%;
                justify-content: flex-start;
            }
        }

        /* ================= EMPTY STATE ================= */
        .no-data {
            text-align: center;
            padding: 30px;
            color: #9ca3af;
            display: none;
            font-style: italic;
        }
    </style>
</head>
<body>

<header>
    <div class="header-brand">
       
        <h2>LectTrack</h2>
    </div>
    <div class="header-actions">
        
        <button onclick="window.location.href='{{ url('/admin/dashboard') }}'">
            <i class="fas fa-home"></i> Home
        </button>
    </div>
</header>

<div class="table-container">

    <div class="table-header">
        <div>
            <div class="table-title">Lecturer List</div>

            <div class="counter-card">
                Total Lecturers
                <span id="lecturerCount">0</span>
            </div>
        </div>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search by name, department or contact">
        </div>
    </div>


    <table id="lecturerTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Contact</th>
                <th>Status & Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($lecturers as $lecturer)
            <tr>
                <td>
                    <div style="font-weight: 600;">{{ $lecturer->nama }}</div>
                </td>
                <td>{{ $lecturer->department }}</td>
                <td>{{ $lecturer->phone ?? '-' }}</td>
                <td>
                    <div class="status-cell">
                        @php
                            $status = $lecturer->status;
                            $class = 'other'; // Default to other
                            $statusLower = strtolower($status);

                            // Logik Color-Coding Status
                            if (str_contains($statusLower, 'cuti') || str_contains($statusLower, 'mc') || str_contains($statusLower, 'others')) $class = 'cuti';
                            elseif (str_contains($statusLower, 'mesyuarat') || str_contains($statusLower, 'program')) $class = 'mesyuarat';
                            elseif (str_contains($statusLower, 'kursus') || str_contains($statusLower, 'bengkel')) $class = 'kursus';
                            elseif (str_contains($statusLower, 'in-college') || str_contains($statusLower, 'bertugas')) $class = 'in-college';
                            else $class = 'other';
                        @endphp

                

                        <div class="action-button-group">
                            <a href="{{ url('/lecturer/report/' . $lecturer->id) }}" class="action-button report">
                                <i class="fas fa-chart-line"></i> Report
                            </a>
                            <a href="{{ url('/lecturer/print/' . $lecturer->id) }}" target="_blank" class="action-button print">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="no-data" id="noData">
        <i class="fas fa-exclamation-circle"></i> No lecturer found matching your search.
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("lecturerTable");
    const rows = table.querySelectorAll("tbody tr");
    const counter = document.getElementById("lecturerCount");
    const noData = document.getElementById("noData");

    // Initialize counter
    counter.textContent = rows.length;

    searchInput.addEventListener("keyup", () => {
        const value = searchInput.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            // Search across the first 3 columns (Name, Dept, Contact)
            const rowCells = row.querySelectorAll('td:nth-child(-n+3)');
            let rowText = '';
            rowCells.forEach(cell => {
                rowText += cell.innerText + ' ';
            });
            const text = rowText.toLowerCase();
            
            const match = text.includes(value);
            row.style.display = match ? "" : "none";
            if (match) visibleCount++;
        });

        counter.textContent = visibleCount;
        noData.style.display = visibleCount === 0 ? "block" : "none";
    });
});
// Fungsi toggleMenu dan event listener click kini tidak diperlukan kerana dropdown telah dibuang.
</script>

</body>
</html>