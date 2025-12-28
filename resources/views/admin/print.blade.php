<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Report - {{ $lecturer->nama }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Base Print Styles */
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            padding: 0;
            background: #eee;
        }

        /* A4 Page Container (Simulate PDF page) */
        .a4-page {
            background: white;
            width: 210mm; 
            min-height: 297mm; 
            margin: 30mm auto; 
            padding: 20mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Print Media Query (Essential for clean PDF printing) */
        @media print {
            body { margin: 0; padding: 0; background: none; }
            .a4-page {
                margin: 0;
                box-shadow: none;
                padding: 15mm; /* Reduce padding for better print area */
            }
            /* Hide URL links, buttons, etc. */
            a { text-decoration: none; color: inherit; } 
            .no-print { display: none !important; }
        }

        /* --- Header & Logos --- */
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo-group {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .logo-group img {
            height: 40px; /* Saiz standard untuk logo */
            width: auto;
        }
        
        .report-title h1 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .report-title p {
            font-size: 12px;
            color: #475569;
            margin: 2px 0 0 0;
        }

        /* --- Profile Summary --- */
        h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .profile-info-grid strong {
            display: inline-block;
            width: 120px;
            color: #475569;
        }

        /* --- Summary Box --- */
        .summary-box {
            display: flex;
            justify-content: space-around;
            text-align: center;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 10px 0;
            margin-bottom: 25px;
        }

        .summary-item {
            flex: 1;
            padding: 5px 10px;
            border-right: 1px solid #e5e7eb;
        }
        .summary-item:last-child {
            border-right: none;
        }
        .summary-value {
            font-size: 22px;
            font-weight: 800;
            color: #2563eb;
            line-height: 1.2;
        }
        .summary-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
        }

        /* --- Attendance Table --- */
        .attendance-table table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .attendance-table th, .attendance-table td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
        }

        .attendance-table th {
            background-color: #f1f5f9;
            font-weight: 700;
            color: #1f2937;
            text-transform: uppercase;
        }
        
        .attendance-table tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        /* --- Signature Section --- */
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .signature-block {
            width: 45%;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #0f172a;
            height: 50px; /* Ruang untuk tandatangan */
            margin-bottom: 5px;
        }

        .signer-title {
            font-weight: 700;
            color: #0f172a;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="a4-page">
        
        <div class="report-header">
            <div class="logo-group">
                {{-- Logo KV: Ganti 'logoKV.png' dengan nama fail sebenar anda --}}
                <img src="{{ asset('images/logoKV.png') }}" alt="KV Logo">
                {{-- Logo LectTrack: Ganti 'logo1.png' dengan nama fail sebenar anda --}}
                <img src="{{ asset('images/logo1.png') }}" alt="LectTrack Logo">
            </div>
            <div class="report-title">
                <h1>LECTURER PERFORMANCE REPORT</h1>
                <p>Period: {{ $startDate->format('d M Y') }} to {{ $endDate->format('d M Y') }}</p>
            </div>
        </div>

        <h2>Lecturer Profile Details</h2>
        <div class="profile-info-grid">
            <div>
                <strong>Name:</strong> {{ $lecturer->nama }}
            </div>
            <div>
                <strong>Staff ID:</strong> {{ $lecturer->identity ?? '-' }}
            </div>
            <div>
                <strong>Department:</strong> {{ $lecturer->department }}
            </div>
            <div>
                <strong>Email:</strong> {{ $lecturer->email ?? '-' }}
            </div>
            <div>
                <strong>Contact:</strong> {{ $lecturer->phone ?? '-' }}
            </div>
            <div>
                <strong>Report Date:</strong> {{ now()->format('d M Y') }}
            </div>
        </div>

        <h2>Summary Statistics (Total {{ $total_days_in_period }} Days)</h2>
        <div class="summary-box">
            <div class="summary-item">
                <div class="summary-value">{{ $percentage_present }}%</div>
                <div class="summary-label">In-College Attendance</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ round(($days_off_mc / $total_days_in_period) * 100, 1) }}%</div>
                <div class="summary-label">Medical Leave (MC) Percentage</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ $days_annual_leave }}</div>
                <div class="summary-label">Annual Leave Taken (Days)</div>
            </div>
        </div>

        <h2>Detailed Absence/Off-Campus Records</h2>
        <div class="attendance-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 15%;">Start Date</th>
                        <th style="width: 15%;">End Date</th>
                        <th style="width: 10%;">Days</th>
                        <th style="width: 25%;">Type/Selection</th>
                        <th style="width: 35%;">Location/Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendanceRecords as $record)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($record->date_submit)->format('d M Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($record->date_end)->format('d M Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($record->date_submit)->diffInDays(Carbon\Carbon::parse($record->date_end)) + 1 }}</td>
                            <td>{{ ucfirst(strtolower($record->selection)) }}</td>
                            <td>{{ $record->location }}: {{ $record->remarks }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; font-style: italic;">No specific absence/off-campus records found for this period.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
        <div class="signature-section">
            <div class="signature-block">
                Report Prepared By:<br>
                <div class="signature-line"></div>
                (Administrator / Head of Department)<br>
                Date: {{ now()->format('d M Y') }}
            </div>

            <div class="signature-block">
                Report Acknowledged and Approved By:<br>
                <div class="signature-line"></div>
                <div class="signer-title">
                    (DIRECTOR SIGNATURE / CAP)
                </div>
            </div>
        </div>

    </div>

    {{-- Script untuk memulakan dialog cetakan secara automatik --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Memberi sedikit masa kepada browser untuk memuatkan semua CSS dan imej
            setTimeout(function() {
                window.print();
            }, 500); 
        });
    </script>

</body>
</html>