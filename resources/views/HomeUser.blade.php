<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>LectTrack - Home</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="{{ asset('css/homeuser.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<video autoplay loop muted playsinline id="bg-video">
    <source src="{{ asset('images/bgg.mp4') }}" type="video/mp4">
</video>
<div class="bg-overlay"></div>
<header class="navbar">
   <div class="nav-left">
    <div class="logo">
        <a href="{{ route('user.home') }}">
            <img src="{{ asset('images/logo1.png') }}" alt="LectTrack Logo" style="height: 45px;">
        </a>
    </div>
</div>

    <div class="nav-center">
        HI, Welcome <strong>{{ $lecturerName ?? 'Pensyarah' }}</strong>
    </div>

    <div class="nav-right">
        <!-- profile (left-most of right group) -->
        <div class="profile-wrapper">

        @php
    $img = $lecturerImage ?? session('lecturer_image') ?? null;
@endphp

<img src="{{ $img ? asset('uploads/' . $img) : asset('images/default.jpg') }}"
     class="profile-img"
     id="profileIcon">

           <div class="profile-dropdown" id="profileDropdown">
    <a href="{{ route('lecturer.information') }}">View Profile</a>
    <a href="{{ route('lecturer.information') }}">Edit Profile</a>

   <a href="#" onclick="event.preventDefault(); document.getElementById('changePassForm').submit();">
        Change Password
    </a>

    <form id="changePassForm" action="{{ route('user.request_change_password') }}" method="POST" style="display:none;">
        @csrf
    </form>

    <a href="{{ route('lecturer.help') }}">Help / Support</a>
</div>

        </div>

        <!-- notification -->
<div class="notification-wrapper">
    <img src="{{ asset('images/noti.png') }}" class="notification-img" id="notifIcon" alt="Notif">
    <span class="notif-badge" id="notifBadge" style="display:none;">0</span>

    <div class="notification-dropdown" id="notifDropdown">
        <p class="notif-title">Recent Notifications</p>
        <ul class="notif-list" id="dynamicNotifList">
            </ul>
        <a href="javascript:void(0);" onclick="clearAll()" style="display:block;text-align:center;margin-top:6px;color:var(--blue);text-decoration:none;font-weight:600;">Clear All</a>
    </div>
</div>

        <!-- logout -->
        <button id="logout-btn">Log Out</button>
    </div>
</header>

<div class="main-content">
    <div class="header-intro">
        <img src="{{ asset('images/logoKV.png') }}" class="main-logo-kv">
        <h1>WELCOME TO LECTTRACK</h1>
        <p>Lecturer Attendance Management System For Professional Institutions</p>
    </div>

    <div class="dashboard-grid">
        <a href="{{ route('attendance.form') }}" class="menu-card">
            <div class="icon-box bg-blue">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3>Record Attendance</h3>
            <p>Submit your daily attendance quickly and easily.</p>
            <span class="btn-action">Record Now <i class="fas fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('attendance.history', $lecturerID) }}" class="menu-card">
            <div class="icon-box bg-green">
                <i class="fas fa-history"></i>
            </div>
            <h3>History Attendance</h3>
            <p>View and track all your previous attendance records.</p>
            <span class="btn-action">View History <i class="fas fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('lecturer.information') }}" class="menu-card">
            <div class="icon-box bg-purple">
                <i class="fas fa-user-tie"></i>
            </div>
            <h3>View Information</h3>
            <p>Check and update your personal profile details.</p>
            <span class="btn-action">View Profile <i class="fas fa-arrow-right"></i></span>
        </a>
    </div>
</div>
<!-- BAHAGIAN AI -->
<div id="ai-btn">
    <img src="{{ asset('images/robot.png') }}" width="40">
</div>

<div id="ai-chatbox">
    <div id="chat-header">LectTrack AI Assistant</div>

    <div id="language-selection">
        <p>Sila pilih bahasa | Please select language:</p>
        <button id="lang-my" data-lang="my">🇲🇾 Melayu</button>
        <button id="lang-en" data-lang="en">🇬🇧 English</button>
    </div>

    <div id="chat-log"></div>

    <div id="chat-input-box">
        <input type="text" id="chat-input" placeholder="Ask your question..." autocomplete="off">
        <button id="chat-send-btn"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>



<!-- footer unchanged (keep your existing footer HTML) -->
<div class="footer-wrapper">
    <!-- ... your footer content (kept as before) ... -->
    <div class="footer-top">
        Get connected with us on social networks:
        <br>
        <a href="https://www.facebook.com/share/1A657QXC3x/?mibextid=wwXIfr" target="_blank" style="color: inherit; text-decoration: none;"> <i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/kvbalikpulauofficial?igsh=MWNnYmtsamlyZTM0aw==" target="_blank" style="color: inherit; text-decoration: none;"> <i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/@kvbalikpulaumedia4020" target="_blank" style="color: inherit; text-decoration: none;"><i class="fab fa-youtube"></i></a>
    </div>

    <div class="footer-main">
        <div class="footer-col">
            <img src="{{ asset('images/logoKV_white.png') }}" class="footer-logo">
            <img src="{{ asset('images/logo1_white.png') }}" class="footer-logo">
            <p>LectTrack is an academic attendance system designed to help lecturers record, manage, and monitor attendance efficiently.</p>
        </div>
        <div class="footer-col">
            <h3>PRODUCTS</h3>
            <a href="#">Lecturer Panel</a>
            <a href="#">History Module</a>
            <a href="#">Analytics Dashboard</a>
            <a href="#">Weekly Repoart</a>
        </div>
        <div class="footer-col">
            <h3>USEFUL LINKS</h3>
            <a href="https://www.moe.gov.my/">Kementerian Pendidikan Malaysia (KPM)</a>
            <a href="https://www.mbot.org.my/"> Malaysia Board of Technologists</a>
            <a href="https://sites.google.com/view/portalkvbalikpulau/">KVBP Portal</a>
            <a href="#">Help Center</a>
        </div>
        <div class="footer-col">
            <h3>CONTACT</h3>
            <p>📍 Kolej Vokasional Balik Pulau</p>
            <p>📧 lecttrack@gmail.com</p>
            <p>📞 +60 19 444 5608</p>
        </div>
    </div>

    <div class="footer-bottom">© 2025 LectTrack • All Rights Reserved</div>
</div>

<div id="logoutModal">
    <div class="modal-box">
        <h3>Log Out?</h3>
        <p>Are you sure you want to log out?</p>
        <div class="modal-buttons">
            <button class="modal-btn cancel-btn" id="cancelLogout">Cancel</button>
            <form method="POST" action="{{ route('lecturer.logout') }}">
                @csrf
                <button type="submit" class="modal-btn cancel-btn">Log Out</button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('Script/HomeUser.js') }}"></script>
</body>
</html>
