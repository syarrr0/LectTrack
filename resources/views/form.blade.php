<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text",
            "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;

            background: url('{{ asset("images/bg-form.jpeg") }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* HEADER BAR */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 70px;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            padding: 0 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            z-index: 999;
        }

        .header-title {
             font-family:'Poppins', sans-serif;
            margin-left:18px;
            flex-grow: 1;
            color: #111;
            font-size: 26px;
            font-weight: 800;
             text-decoration: none;
    cursor: pointer;
    
        }

        /* BACK BUTTON */
        .back-btn {
            padding: 10px 18px;
            background: #1A73FF;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
            transition: 0.25s;
        }

        .back-btn:hover {
            background: #0f5bd7;
        }

        /* MAIN PAGE */
        .page-wrapper {
            width: 90%;
            max-width: 1200px;
            margin-top: 120px;
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.12);
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }

        .left-panel {
            padding: 60px 50px;
            background: #3f75e78a;
        }

        .left-panel img {
            width: 200px;
            margin-bottom: 25px;
        }

        .left-title-small {
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 2px;
            color: #000000ff;
            font-weight: 600;
        }

        .left-title-big {
            font-size: 32px;
            font-weight: 800;
            margin: 10px 0 25px 0;
            color: #111;
            line-height: 1.2;
            max-width: 300px;
        }

        .left-desc {
            color: #000000ff;
            font-size: 15px;
            max-width: 300px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .contact-box {
            margin-top: 40px;
        }

        .contact-title {
            font-size: 14px;
            color: #000000ff;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .contact-item {
            display: flex;
            gap: 14px;
            margin-bottom: 20px;
        }

        .contact-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #3131314b;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
        }

        .contact-label {
            color: #000000ff;
            font-size: 13px;
            font-weight: 600;
        }

        .contact-value {
            font-size: 15px;
            font-weight: 600;
            color: #222;
        }

        /* RIGHT PANEL */
        .right-panel {
            padding: 50px 55px;
            background: white;
            min-height: 80px;
            
        }

        h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 25px;
        }

        .datetime-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .datetime-date {
            font-size: 18px;
            font-weight: 600;
        }

        .datetime-time {
            font-size: 34px;
            font-weight: 700;
            margin-top: 6px;
        }

        /* ALL INPUTS TURUN KE BAWAH */
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .input-group {
            position: relative;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #d0d0d0;
            background: #fafafa;
            font-size: 15px;
        }

        .input-group label {
            position: absolute;
            top: 13px;
            left: 14px;
            font-size: 15px;
            color: #777;
            pointer-events: none;
            transition: 0.25s;
            background: white;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label,
        .input-group select:focus + label,
        .input-group select:not([value=""]) + label,
        .input-group select:valid + label {
            top: -9px;
            font-size: 12px;
            font-weight: 600;
            color: #6C63FF;
            padding: 0 4px;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            border-radius: 14px;
            border: none;
            background: #6C63FF;
            color: #fff;
            font-size: 18px;
            margin-top: 30px;
            cursor: pointer;
            font-weight: 600;
        }

        @media(max-width: 900px) {
            .page-wrapper {
                grid-template-columns: 1fr;
            }
            .left-panel {
                text-align: center;
            }
        }

        @media(max-width: 650px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        /* POPUP */
        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 200;
        }

        .popup-box {
            background: white;
            width: 90%;
            max-width: 450px;
            border-radius: 12px;
            padding: 25px;
            animation: pop 0.2s ease-out;
        }

        @keyframes pop {
            from { transform: scale(0.85); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }

        .popup-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-cancel {
            padding: 10px 20px;
            background: #ccc;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-confirm {
            padding: 10px 20px;
            background: #6C63FF;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header">
     <a href="{{ route('lecturer.dashboard') }}" class="header-title">LECTTRACK</a>
    <a href="{{ route('lecturer.dashboard') }}" class="back-btn">← Back</a>
</div>

<div class="page-wrapper">

    <!-- LEFT PANEL -->
    <div class="left-panel">

        <img src="{{ asset('images/logoKV.png') }}">
        <img src="{{ asset('images/logo1.png') }}">

        <div class="left-title-small">We're here to help you</div>

        <div class="left-title-big">
            Record Your Attendance Easily
        </div>

        <p class="left-desc">
            Fill in the details on the right. Ensure all information is accurate before submitting.
        </p>

        <div class="contact-box">
            <div class="contact-title">If there are any problems filling in or if it fails, please contact:</div>

            <div class="contact-item">
                <div class="contact-icon">✉️</div>
                <div>
                    <div class="contact-label">E-mail</div>
                    <div class="contact-value">lecttrack@kvbp.edu.my</div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">📞</div>
                <div>
                    <div class="contact-label">Phone number</div>
                    <div class="contact-value">+019 444 5608</div>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">

        <h2>Record Attendance</h2>

        <div class="datetime-box">
            <div id="liveDate" class="datetime-date"></div>
            <div id="liveTime" class="datetime-time"></div>
        </div>

        <form id="attendanceForm">
            @csrf
            <input type="hidden" name="lecturer_id" value="{{ session('lecturer_id') }}">

            <div class="grid">

                <div class="input-group">
                    <select name="selection" id="selection" required>
                        <option value="" disabled selected></option>
                        <option value="CUTI(MC)">CUTI (MC)</option>
                        <option value="KURSUS/BENGKEL">KURSUS/BENGKEL</option>
                        <option value="MESYUARAT">MESYUARAT</option>
                        <option value="OTHERS">OTHERS</option>
                    </select>
                    <label>Pilihan Tujuan</label>
                </div>

                <div class="input-group">
                    <input type="date" name="date_submit" id="date_submit" required>
                    <label>Tarikh Mula</label>
                </div>

                <div class="input-group">
                    <input type="date" name="date_end" id="date_end" required>
                    <label>Tarikh Tamat</label>
                </div>

                <div class="input-group">
                    <input type="time" name="time" id="time" required>
                    <label>Waktu Mula</label>
                </div>

                <div class="input-group">
                    <input type="time" name="time_out" id="time_out" required>
                    <label>Waktu Tamat</label>
                </div>

                <div class="input-group">
                    <input type="text" name="location" id="tempat" required>
                    <label>Lokasi</label>
                </div>

                <div class="input-group">
                    <input type="text" name="remarks" id="remarks" required>
                    <label>Remarks (Nama Aktiviti)</label>
                </div>

            </div>

            <button type="button" class="submit-btn" onclick="openPopup()">Submit Attendance</button>
        </form>

    </div>

</div>

<!-- POPUP -->
<div class="popup-overlay" id="popup">
    <div class="popup-box">
        <h3>Confirm Your Attendance</h3>
        <div id="popupContent"></div>

        <div class="popup-buttons">
            <button class="btn-cancel" onclick="closePopup()">Cancel</button>
            <button class="btn-confirm" onclick="submitForm()">Confirm</button>
        </div>
    </div>
</div>

<!-- SUCCESS POPUP -->
<div class="popup-overlay" id="successPopup">
    <div class="popup-box">
        <h3 style="text-align:center;">Attendance Submitted</h3>
        <p style="text-align:center;">Your attendance has been recorded successfully.</p>

        <div style="text-align:center;">
            <button onclick="closeSuccessPopup()" class="btn-confirm">OK</button>
        </div>
    </div>
</div>

<script>
    function loadDateTime() {
        const now = new Date();

        const dateOptions = {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        };

        document.getElementById("liveDate").textContent =
            now.toLocaleDateString('en-GB', dateOptions);

        let h = now.getHours();
        let m = String(now.getMinutes()).padStart(2, "0");
        let ampm = h >= 12 ? "PM" : "AM";
        let displayH = h % 12 || 12;

        document.getElementById("liveTime").textContent =
            `${displayH}:${m} ${ampm}`;
    }

    loadDateTime();
    setInterval(loadDateTime, 1000);

    function openPopup() {
        const form = document.getElementById('attendanceForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        let details = `
            <p><strong>Lecturer ID:</strong> {{ session('lecturer_id') }}</p>
            <p><strong>Pilihan:</strong> ${selection.value}</p>
            <p><strong>Tarikh Mula:</strong> ${date_submit.value}</p>
            <p><strong>Tarikh Tamat:</strong> ${date_end.value}</p>
            <p><strong>Waktu Masuk:</strong> ${time.value}</p>
            <p><strong>Waktu Keluar:</strong> ${time_out.value}</p>
            <p><strong>Lokasi:</strong> ${tempat.value}</p>
            <p><strong>Remarks:</strong> ${remarks.value}</p>
        `;

        document.getElementById("popupContent").innerHTML = details;
        document.getElementById("popup").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    function submitForm() {
        document.getElementById("popup").style.display = "none";

        let formData = new FormData(document.getElementById("attendanceForm"));

        fetch("{{ route('attendance.submit') }}", {
            method: "POST",
            body: formData
        })
            .then(res => showSuccessPopup())
            .catch(err => alert("Submission failed."));
    }

    function showSuccessPopup() {
        document.getElementById("successPopup").style.display = "flex";
    }

    function closeSuccessPopup() {
        document.getElementById("successPopup").style.display = "none";
        window.location.href = "{{ route('lecturer.dashboard') }}";
    }
</script>

</body>
</html>
