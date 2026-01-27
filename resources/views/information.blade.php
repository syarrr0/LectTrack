<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Lecturer Information </title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        :root {
            --primary: #007AFF;
            --navy: #001A35;
            --text-dark: #1D1D1F;
            --text-grey: #86868B;
            --bg-light: #F5F5F7;
            --white: #FFFFFF;
            --glass: rgba(255, 255, 255, 0.7);
            --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.04);
            --border: 1px solid rgba(0, 0, 0, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        .mesh-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 10% 20%, #e0eaff 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, #f0f4ff 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, #ffffff 0%, transparent 50%);
            filter: blur(60px);
        }

        /* HEADER */
        .header-bar {
            width: 100%;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10%;
            position: fixed;
            top: 0; z-index: 1000;
            border-bottom: var(--border);
        }

        .header-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--navy);
        }

        .back-button {
            background: var(--navy);
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* WRAPPER */
        .wrapper { padding: 120px 20px 60px; max-width: 1000px; margin: auto; }

        /* PROFILE SECTION - FIX KEDUDUKAN BUTANG */
        .profile-section { 
            display: flex;           /* Guna Flexbox */
            flex-direction: column;  /* Susun secara menegak */
            align-items: center;     /* Letak di tengah secara mendatar */
            text-align: center; 
            margin-bottom: 25px; 
        }

        .img-wrapper {
            position: relative;
            display: inline-block;
            padding: 10px;
            background: white;
            border-radius: 55px;
            box-shadow: var(--shadow-premium);
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .profile-section img {
            width: 180px; height: 180px;
            border-radius: 45px;
            object-fit: cover;
            display: block;
        }

        .edit-btn {
            margin-top: 20px; /* Jarak antara gambar dan butang */
            padding: 15px 35px;
            background: var(--white);
            color: var(--navy);
            border-radius: 20px;
            border: var(--border);
            font-weight: 800;
            font-size: 13px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: var(--shadow-premium);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: fit-content; /* Pastikan lebar butang ikut teks sahaja */
        }
        .edit-btn:hover { background: var(--navy); color: white; transform: translateY(-3px); }

        /* QUICK INFO ROW */
        .quick-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 20px;
        }

        .quick-info-card {
            background: var(--glass);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 35px;
            box-shadow: var(--shadow-premium);
            border: 1px solid rgba(255,255,255,0.7);
        }

        .quick-info-card h3 {
            font-size: 11px;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }
        .stat-label { font-size: 14px; font-weight: 500; color: var(--text-grey); }
        .stat-value { font-size: 14px; font-weight: 700; color: var(--navy); }

        /* INFORMATION SECTIONS */
        .info-section {
            background: var(--glass);
            backdrop-filter: blur(15px);
            margin-bottom: 25px;
            padding: 40px;
            border-radius: 40px;
            box-shadow: var(--shadow-premium);
            border: 1px solid rgba(255,255,255,0.7);
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title::before {
            content: ''; width: 6px; height: 24px;
            background: var(--primary); border-radius: 10px;
        }

        .info-box p {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0,0,0,0.02);
            font-size: 15px;
        }

        .label-text { font-weight: 700; color: var(--text-grey); width: 200px; flex-shrink: 0; }
        .value-text { font-weight: 600; color: var(--text-dark); }

        /* MODAL */
        .modal-bg {
            position: fixed; inset: 0;
            background: rgba(0, 26, 53, 0.15);
            backdrop-filter: blur(20px);
            display: none; justify-content: center; align-items: center; z-index: 2000;
        }

        .modal-box {
            width: 90%; max-width: 500px;
            background: var(--white);
            border-radius: 40px;
            padding: 45px;
            box-shadow: 0 50px 100px rgba(0,0,0,0.1);
        }

        .modal-box input {
            width: 100%; padding: 16px; border-radius: 18px;
            border: 2px solid #F1F5F9; margin-top: 10px; margin-bottom: 20px;
            font-size: 15px; background: #F8FAFC; font-weight: 600;
        }

        .btn-ui { flex: 1; padding: 18px; border-radius: 20px; font-weight: 800; cursor: pointer; border: none; }
        .btn-save { background: var(--navy); color: white; }
        .btn-cancel { background: #F1F5F9; color: var(--text-grey); }

        @media (max-width: 768px) {
            .quick-info-row { grid-template-columns: 1fr; }
            .label-text { width: 130px; font-size: 13px; }
            .header-bar { padding: 0 5%; }
        }
    </style>
</head>

<body>

<div class="mesh-bg" id="meshBackground"></div>

<div class="header-bar">
    <div class="header-title">Lecturer Information</div>
    <button class="back-button" onclick="window.history.back()">
        <i class="fas fa-arrow-left"></i> BACK
    </button>
</div>

<div id="mainContent" class="wrapper">

    <div class="profile-section animate-entry">
        <div class="img-wrapper">
            <img id="profileDisplay" 
                 src="{{ $lecturer->image ? asset('uploads/'.$lecturer->image) : asset('images/default.jpg') }}" 
                 alt="Profile">
        </div>
        
        <button class="edit-btn" onclick="openModal()">
            <i class="fas fa-magic"></i> &nbsp; UPDATE INFORMATION
        </button>
    </div>

    <div class="quick-info-row">
        <div class="quick-info-card reveal">
            <h3>Academic</h3>
            <div class="stat-item">
                <span class="stat-label">Designation</span>
                <span class="stat-value">Lecturer / Staff</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Department</span>
                <span class="stat-value">{{ $lecturer->department }}</span>
            </div>
        </div>

        <div class="quick-info-card reveal">
            <h3>Current Status</h3>
            <div class="stat-item">
                <span class="stat-label">Duty Time</span>
                <span class="stat-value" style="font-size: 12px;">{{ $stats['office_hours'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Attendance Rate</span>
                <span class="stat-value" style="color: #10b981;">{{ $stats['attendance_rate'] }}</span>
            </div>
        </div>
    </div>

    <div class="info-section reveal">
        <h2 class="section-title">Personal Information</h2>
        <div class="info-box">
            <p><span class="label-text">Full Name</span> <span class="value-text">{{ $lecturer->nama }}</span></p>
            <p><span class="label-text">Faculty</span> <span class="value-text">{{ $lecturer->department }}</span></p>
            <p><span class="label-text">Phone Number</span> <span class="value-text">{{ $lecturer->phone }}</span></p>
            <p><span class="label-text">Email Address</span> <span class="value-text">{{ $lecturer->email }}</span></p>
        </div>
    </div>

    <div class="info-section reveal">
        <h2 class="section-title">Latest Attendance</h2>
        @if($attendance)
        <div class="info-box">
            <p><span class="label-text">Date Logged</span> <span class="value-text">{{ $attendance->date_submit }}</span></p>
            <p><span class="label-text">Check-in Time</span> <span class="value-text">{{ $attendance->time }} {{ isset($attendance->time_out) ? '- '.$attendance->time_out : '' }}</span></p>
            <p><span class="label-text">Current Location</span> <span class="value-text"><i class="fas fa-location-dot" style="color:#ef4444"></i> {{ $attendance->location }}</span></p>
            <p><span class="label-text">Remarks</span> <span class="value-text" style="font-style: italic;">"{{ $attendance->remarks }}"</span></p>
        </div>
        @else
        <div style="padding:20px; text-align:center; color: var(--text-grey); background: rgba(0,0,0,0.02); border-radius: 20px;">
            <i class="fas fa-info-circle"></i> &nbsp; No recent records found.
        </div>
        @endif
    </div>

    <div style="text-align:center; margin-top: 40px; color: var(--text-grey); font-size: 12px; font-weight: 600;">
        © 2025 LECTTRACK SYSTEM • LECTURER INFORMATION 
    </div>
</div>

<div id="editModal" class="modal-bg">
    <div class="modal-box" id="modalBox">
        <div style="text-align:center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:var(--navy);">Update Profile</h2>
            <p style="font-size:13px; color:var(--text-grey);">Keep your information up to date</p>
        </div>

        <form action="{{ route('lecturer.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label style="font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase;">Name</label>
            <input type="text" name="nama" value="{{ $lecturer->nama }}">

            <label style="font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase;">Department</label>
            <input type="text" name="department" value="{{ $lecturer->department }}">

            <label style="font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase;">Phone</label>
            <input type="text" name="phone" value="{{ $lecturer->phone }}">

            <label style="font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase;">Email</label>
            <input type="email" name="email" value="{{ $lecturer->email }}">

            <label style="font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase;">New Photo</label>
            <input type="file" name="image" style="background:none; border:none; padding:10px 0;">

            <div class="modal-actions" style="display:flex; gap:15px;">
                <button type="button" onclick="closeModal()" class="btn-ui btn-cancel">CANCEL</button>
                <button type="submit" class="btn-ui btn-save">SAVE CHANGES</button>
            </div>
        </form>
    </div>
</div>

<script>
    // GSAP Entrance Animations
    window.onload = () => {
        const tl = gsap.timeline();
        tl.from(".header-bar", { y: -100, opacity: 0, duration: 1, ease: "power4.out" })
          .from(".animate-entry", { scale: 0.8, opacity: 0, duration: 1, ease: "back.out(1.7)" }, "-=0.5")
          .from(".reveal", { 
            y: 40, opacity: 0, duration: 0.8, stagger: 0.2, ease: "power3.out" 
          }, "-=0.5");
    };

    function openModal() {
        document.getElementById("editModal").style.display = "flex";
        document.getElementById("mainContent").classList.add("blurred");
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
        document.getElementById("mainContent").classList.remove("blurred");
    }
</script>

</body>
</html>