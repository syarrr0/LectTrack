<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Record | LectTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --navy-deep: #001A35;
            --navy-soft: #002B5B;
            --light-blue-bg: #F0F7FF;
            --accent-blue: #0070FF;
            --white: #FFFFFF;
            --glass-white: rgba(255, 255, 255, 0.85);
            --border-subtle: rgba(0, 26, 53, 0.1);
            --text-main: #001A35;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--light-blue-bg);
            background-image: 
                radial-gradient(at 0% 0%, rgba(0, 112, 255, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 43, 91, 0.05) 0px, transparent 50%);
            min-height: 100vh;
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* --- MODERN NAVY HEADER --- */
        .navbar {
            width: 100%;
            height: 80px;
            background: var(--navy-deep);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 8%;
            position: fixed;
            top: 0;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .logo {
            color: var(--white);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .back-link {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 14px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.1);
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-link:hover {
            background: var(--white);
            color: var(--navy-deep);
            transform: translateY(-2px);
        }

        /* --- MAIN CONTENT AREA --- */
        .wrapper {
            width: 100%;
            max-width: 1100px;
            margin-top: 130px;
            padding: 0 20px 60px;
            display: grid;
            grid-template-columns: 0.7fr 1.3fr;
            gap: 60px;
            align-items: start;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            color: var(--navy-deep);
            margin-bottom: 24px;
            letter-spacing: -1px;
        }

        .hero-section p {
            color: var(--text-muted);
            font-size: 17px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .support-card {
            background: var(--white);
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 15px 35px rgba(0, 26, 53, 0.03);
        }

        .support-item {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .support-item:last-child { margin-bottom: 0; }

        .icon-box {
            width: 45px;
            height: 45px;
            background: var(--light-blue-bg);
            color: var(--accent-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .support-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .support-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy-deep);
        }

        /* ATTENDANCE FORM CARD */
        .form-card {
            background: var(--white);
            padding: 50px;
            border-radius: 35px;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 40px 80px rgba(0, 26, 53, 0.06);
        }

        .form-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-title::before {
            content: '';
            width: 5px;
            height: 25px;
            background: var(--accent-blue);
            border-radius: 10px;
        }

        .form-grid {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .input-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .input-stack label {
            font-size: 13px;
            font-weight: 700;
            color: var(--navy-deep);
            padding-left: 4px;
        }

        .input-stack input, .input-stack select {
            padding: 16px 20px;
            border-radius: 16px;
            border: 1.5px solid #E2E8F0;
            background: #F8FAFC;
            font-size: 15px;
            transition: 0.3s;
            color: var(--text-main);
            width: 100%;
        }

        .input-stack input:focus, .input-stack select:focus {
            border-color: var(--accent-blue);
            background: var(--white);
            outline: none;
            box-shadow: 0 0 0 5px rgba(0, 112, 255, 0.1);
        }

        .dual-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background: var(--navy-deep);
            color: var(--white);
            border: none;
            padding: 20px;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
            box-shadow: 0 10px 25px rgba(0, 26, 53, 0.2);
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--navy-soft);
            transform: translateY(-3px);
            box-shadow: 0 20px 35px rgba(0, 26, 53, 0.25);
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 26, 53, 0.4);
            backdrop-filter: blur(10px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            padding: 20px;
        }

        .modal-box {
            background: var(--white);
            padding: 40px;
            border-radius: 30px;
            max-width: 450px;
            width: 100%;
            text-align: center;
            box-shadow: 0 40px 70px rgba(0,0,0,0.15);
        }

        .loader-ring {
            width: 50px;
            height: 50px;
            border: 4px solid #F1F5F9;
            border-top: 4px solid var(--accent-blue);
            border-radius: 50%;
            animation: rotate 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        @media (max-width: 950px) {
            .wrapper { grid-template-columns: 1fr; margin-top: 100px; }
            .hero-section { text-align: center; }
            .support-item { justify-content: center; }
            .form-card { padding: 35px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo">Status Record</div>
    <a href="{{ route('lecturer.dashboard') }}" class="back-link">
        <i class="fas fa-chevron-left"></i> BACK TO HOME
    </a>
</nav>

<div class="wrapper">
    <section class="hero-section">
        <h1>Record Your Attendance</h1>
        <p>A smart, efficient, and professional way to manage your daily academic activities.</p>
        
        <div class="support-card">
            <div class="support-item">
                <div class="icon-box"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="support-label">Support Email</div>
                    <div class="support-value">lecttrack@kvbp.edu.my</div>
                </div>
            </div>
            <div class="support-item">
                <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                <div>
                    <div class="support-label">Direct Line</div>
                    <div class="support-value">+019 444 5608</div>
                </div>
            </div>
        </div>
    </section>

    <div class="form-card">
        <div class="form-title">ATTENDANCE DETAILS</div>
        <form id="attendanceForm">
            @csrf
            <input type="hidden" name="lecturer_id" value="{{ session('lecturer_id') }}">

            <div class="form-grid">
                <div class="input-stack">
                    <label>Pilihan Tujuan</label>
                    <select name="selection" id="selection" required onchange="checkSelection()">
                        <option value="" disabled selected>Select category...</option>
                        <option value="CUTI(MC)">CUTI</option>
                        <option value="KURSUS/BENGKEL">KURSUS/BENGKEL</option>
                        <option value="MESYUARAT">MESYUARAT</option>
                        <option value="OTHERS">OTHERS</option>
                    </select>
                </div>

                <div class="input-stack" id="leaveTypeContainer" style="display: none;">
                    <label>Jenis Cuti</label>
                    <select name="leave_type" id="leave_type">
                        <option value="" disabled selected>Pilih jenis cuti...</option>
                        <option value="Cuti Sakit (MC)">Cuti Sakit (MC)</option>
                        <option value="Cuti Rehat Khas (CRK)">Cuti Rehat Khas (CRK)</option>
                        <option value="Cuti Tanpa Rekod (CTR)">Cuti Tanpa Rekod (CTR)</option>
                    </select>
                </div>

                <div class="dual-columns">
                    <div class="input-stack">
                        <label>Tarikh Mula</label>
                        <input type="date" name="date_submit" id="date_submit" required>
                    </div>
                    <div class="input-stack">
                        <label>Tarikh Tamat</label>
                        <input type="date" name="date_end" id="date_end" required>
                    </div>
                </div>

                <div class="dual-columns" id="timeSection">
                    <div class="input-stack">
                        <label>Waktu Mula</label>
                        <input type="time" name="time" id="time" required>
                    </div>
                    <div class="input-stack">
                        <label>Waktu Tamat</label>
                        <input type="time" name="time_out" id="time_out" required>
                    </div>
                </div>

                <div class="input-stack">
                    <label>Lokasi</label>
                    <input type="text" name="location" id="tempat" placeholder="Enter venue name" required>
                </div>

                <div class="input-stack">
                    <label>Remarks (Nama Aktiviti)</label>
                    <input type="text" name="remarks" id="remarks" placeholder="Provide activity details" required>
                </div>

                <button type="button" class="btn-submit" onclick="requestConfirmation()">
                    SUBMIT FORM
                </button>
            </div>
        </form>
    </div>
</div>

<div class="overlay" id="confirmOverlay">
    <div class="modal-box">
        <i class="fas fa-clipboard-check" style="font-size: 40px; color: var(--accent-blue); margin-bottom: 20px;"></i>
        <h3 style="margin-bottom: 10px;">Confirm Submission?</h3>
        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 30px;">Please ensure all entries are accurate before proceeding.</p>
        <div style="display: flex; gap: 12px;">
            <button class="btn-submit" style="background:#F1F5F9; color:var(--navy-deep); box-shadow:none;" onclick="hideUI('confirmOverlay')">CANCEL</button>
            <button class="btn-submit" onclick="executeSubmission()">CONFIRM & SEND</button>
        </div>
    </div>
</div>

<div class="overlay" id="loadingOverlay">
    <div style="text-align: center;">
        <div class="loader-ring"></div>
        <p style="color: white; font-weight: 600; letter-spacing: 2px;">SYNCING DATA...</p>
    </div>
</div>

<div class="overlay" id="successOverlay">
    <div class="modal-box">
        <div style="width:70px; height:70px; background:#DCFCE7; color:#15803D; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; font-size:28px;">
            <i class="fas fa-check"></i>
        </div>
        <h3 style="margin-bottom: 8px;">Successfully Recorded!</h3>
        <p style="color: var(--text-muted); margin-bottom: 25px;">Your attendance has been securely saved to the LectTrack system.</p>
        <button class="btn-submit" onclick="redirectHome()">RETURN TO DASHBOARD</button>
    </div>
</div>

<script>
    function checkSelection() {
        const mainSelection = document.getElementById('selection').value;
        const leaveContainer = document.getElementById('leaveTypeContainer');
        const leaveSelect = document.getElementById('leave_type');
        const timeSection = document.getElementById('timeSection');
        const locationInput = document.getElementById('tempat');
        const remarksInput = document.getElementById('remarks');
        
        // Input waktu mula/tamat
        const timeStart = document.getElementById('time');
        const timeEnd = document.getElementById('time_out');

        if (mainSelection === 'CUTI(MC)') {
            // Paparkan dropdown jenis cuti
            leaveContainer.style.display = 'flex';
            leaveSelect.required = true;

            // Sembunyikan bahagian Waktu
            timeSection.style.display = 'none';
            timeStart.required = false;
            timeEnd.required = false;

            // Kemaskini placeholder
            locationInput.placeholder = "Contoh: Rumah / Hospital";
            remarksInput.placeholder = "Sila nyatakan sebab cuti";
        } else {
            // Sembunyikan jenis cuti
            leaveContainer.style.display = 'none';
            leaveSelect.required = false;
            leaveSelect.value = ""; 

            // Paparkan semula bahagian Waktu
            timeSection.style.display = 'grid';
            timeStart.required = true;
            timeEnd.required = true;

            // Kembalikan placeholder asal
            locationInput.placeholder = "Enter venue name";
            remarksInput.placeholder = "Provide activity details";
        }
    }

    function requestConfirmation() {
        const form = document.getElementById('attendanceForm');
        if(!form.checkValidity()){ form.reportValidity(); return; }
        document.getElementById('confirmOverlay').style.display = 'flex';
    }

    function hideUI(id) {
        document.getElementById(id).style.display = 'none';
    }

    function executeSubmission() {
        hideUI('confirmOverlay');
        document.getElementById('loadingOverlay').style.display = 'flex';

        let formData = new FormData(document.getElementById("attendanceForm"));

        setTimeout(() => {
            fetch("{{ route('attendance.submit') }}", {
                method: "POST",
                body: formData
            })
            .then(() => {
                document.getElementById('loadingOverlay').style.display = 'none';
                document.getElementById('successOverlay').style.display = 'flex';
            })
            .catch(() => {
                document.getElementById('loadingOverlay').style.display = 'none';
                alert("Network error. Please try again.");
            });
        }, 1500);
    }

    function redirectHome() {
        window.location.href = "{{ route('lecturer.dashboard') }}";
    }
</script>

</body>
</html>