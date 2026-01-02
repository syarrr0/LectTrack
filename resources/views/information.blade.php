<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lecturer Information</title>

<style>
:root {
    --primary: #0A84FF;       /* iOS blue */
    --bg-light: #F5F6F8;      
    --text-dark: #1b1b1b;
    --text-silver: #8c8c8c;
    --radius-big: 24px;
    --radius-small: 14px;
    --shadow-soft: 0 12px 35px rgba(0, 0, 0, 0.17);
    --card-shadow: 0 6px 20px rgba(0, 0, 0, 0.32);
}

/* GLOBAL RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text",
                 "Helvetica Neue", Helvetica, Arial, sans-serif;

    background: url('{{ asset('images/infobg.jpeg') }}') no-repeat center center fixed;
    background-size: cover;

    color: var(--text-dark);
    min-height: 100vh;
}


/* HEADER */
.header-bar {
    width: 100%;
    background: white;
    height: 60px;
    box-shadow: var(--card-shadow);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 22px;
    position: fixed;
    top: 0;
    z-index: 10;
}

.header-title {
    font-size: 20px;
    font-weight: 700;
}

/* BACK BUTTON */
.back-button {
    background: var(--primary);
    color: white;
    padding: 10px 20px;
    border-radius: var(--radius-small);
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.25s;
}

.back-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(10,132,255,0.3);
}

/* MAIN CONTENT */
.wrapper {
    padding: 120px 20px 40px;
    max-width: 1100px;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.blurred {
    filter: blur(8px);
    pointer-events: none;
}

/* PROFILE PHOTO & EDIT BUTTON */
.profile-section { /* Ganti .profile-top untuk menampung kad baru */
    text-align: center;
    margin-bottom: 28px;
    width: 100%;
    max-width: 800px; /* Lebar maksimum sama dengan kad-kad info di bawah */
}

.profile-section img {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    object-fit: cover;
    background: #dcdcdc;
    border: 6px solid white;
    box-shadow: var(--shadow-soft);
}

/* EDIT BUTTON */
.edit-btn {
    margin-top: 18px;
    padding: 12px 32px;
    background: var(--primary);
    color: white;
    border-radius: 20px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    transition: 0.25s;
}

.edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 18px rgba(10,132,255,0.3);
}

/* ===== KAD RINGKAS (KIRI & KANAN) ===== */
.quick-info-row {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 800px;
    margin-bottom: 20px;
    gap: 20px; /* Jarak antara kad */
}

.quick-info-card {
    background: white;
    padding: 20px 24px;
    border-radius: var(--radius-big);
    box-shadow: var(--card-shadow);
    flex: 1; /* Supaya kedua-dua kad mengambil ruang yang sama */
    text-align: left;
}

.quick-info-card h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-silver);
    text-transform: uppercase;
    margin-bottom: 10px;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    padding: 4px 0;
    border-bottom: 1px solid #f0f0f0;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    font-size: 15px;
    font-weight: 500;
    color: var(--text-dark);
}

.stat-value {
    font-size: 15px;
    font-weight: 700;
    color: var(--primary); /* Guna warna primary untuk penekanan */
}
/* ===================================== */


/* CARDS (WHITE SOLID) */
.info-section {
    width: 100%;
    max-width: 800px;
    background: white;
    margin: 15px 0;
    padding: 26px 28px;
    border-radius: var(--radius-big);
    box-shadow: var(--card-shadow);
}

/* SECTION TITLE */
.section-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 12px;
}

/* FIELD TEXT */
.info-box p {
    margin: 10px 0;
    font-size: 16px;
}

.label {
    font-weight: 600;
    display: inline-block;
    width: 150px;
}

/* FOOTER */
.footer {
    text-align: center;
    margin-top: 30px;
    color: var(--text-silver);
    font-size: 13px;
}

/* ===== MODAL (Minimalis Style) ===== */

.modal-bg {
    position: fixed;
    top: 0;
    left: 0;
    width:100%;
    height:100vh;
    background: rgba(0,0,0,0.5); /* Latar belakang gelap ringkas */
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999;
    animation: fadeIn .25s ease;
}

@keyframes fadeIn {
    from { opacity:0; }
    to { opacity:1; }
}

.modal-box {
    width: 460px;
    background: white; /* Putih solid */
    border-radius: var(--radius-small); /* Radius yang lebih kecil */
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); /* Shadow yang lebih ringkas */
    animation: pop .25s ease;
}

@keyframes pop {
    from { transform: scale(0.95); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}

.modal-title {
    text-align:center;
    font-size:20px;
    font-weight:700;
    margin-bottom:18px;
    color: var(--text-dark);
}

/* MODAL INPUT */
.modal-box label {
    font-weight:600;
    font-size:14px;
    margin-top:10px;
    display:block;
    color: var(--text-dark);
}

.modal-box input {
    width: 100%;
    height: 40px; /* Saiz input lebih kecil */
    padding: 8px 12px;
    border-radius: var(--radius-small);
    border: 1px solid #dcdcdc;
    margin-bottom: 12px;
    font-size: 15px;
    background: #fff;
    transition: 0.25s;
    font-family: inherit;
}

.modal-box input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 1px var(--primary);
}

/* MODAL BUTTONS */
.modal-actions {
    display:flex;
    justify-content:flex-end; /* Butang ke kanan */
    margin-top:20px;
    gap: 10px;
}

.btn {
    padding: 10px 20px;
    border:none;
    border-radius:var(--radius-small);
    font-weight:600;
    cursor:pointer;
    transition:0.25s;
}

/* SAVE */
.btn-save {
    background: var(--primary);
    color:white;
}

.btn-save:hover {
    opacity: 0.9;
}

/* CANCEL */
.btn-cancel {
    background:transparent;
    color: var(--text-silver);
}

.btn-cancel:hover {
    color: var(--text-dark);
}
</style>
</head>

<body>

<div class="header-bar">
    <div class="header-title">Lecturer Information</div>
    <button class="back-button" onclick="window.history.back()">Back</button>
</div>

<div id="mainContent" class="wrapper">

    <div class="profile-section">
        <img
            src="{{ $lecturer->image 
                    ? asset('uploads/'.$lecturer->image) 
                    : asset('images/default.jpg') }}">
        <br>
        <button class="edit-btn" onclick="openModal()">EDIT INFORMATION</button>
    </div>

    <div class="quick-info-row">
        <div class="quick-info-card">
            <h3>ACADEMIC</h3>
            <div class="stat-item">
                <span class="stat-label">Designation:</span>
                <span class="stat-value">Head of Department</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Years of Service::</span>
                <span class="stat-value">5 Years</span>
            </div>
        </div>

        <div class="quick-info-card">
            <h3>Current Status</h3>
            <div class="stat-item">
                <span class="stat-label">Duty Time:</span>
                <span class="stat-value">{{ $stats['office_hours'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Monthly Attendance:</span>
                <span class="stat-value">{{ $stats['attendance_rate'] }}</span>
            </div>
        </div>
    </div>
    <div class="info-section">
        <h2 class="section-title">Personal Information</h2>
        <div class="info-box">
            <p><span class="label">Name:</span> {{ $lecturer->nama }}</p>
            <p><span class="label">Department:</span> {{ $lecturer->department }}</p>
            <p><span class="label">Phone Number:</span> {{ $lecturer->phone }}</p>
            <p><span class="label">Email:</span> {{ $lecturer->email }}</p>
        </div>
    </div>

    <div class="info-section">
        <h2 class="section-title">Latest Attendance</h2>

        @if($attendance)
        <div class="info-box">
            <p><span class="label">Date:</span> {{ $attendance->date_submit }}</p>
            <p><span class="label">Start Time:</span> {{ $attendance->time }}</p>
            <p><span class="label">End Date:</span> {{ $attendance->date_end }}</p>
            <p><span class="label">Location:</span> {{ $attendance->location }}</p>
            <p><span class="label">Note:</span> {{ $attendance->remarks }}</p>
        </div>
        @else
        <div style="padding:15px; opacity:0.8;">No attendance record found.</div>
        @endif
    </div>

    <div class="footer">
        This system ensures that your personal information remains confidential.
    </div>
</div>

<div id="editModal" class="modal-bg">
    <div class="modal-box">
        <div class="modal-title">Edit Information</div>

        <form action="{{ route('lecturer.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Name:</label>
            <input type="text" name="nama" value="{{ $lecturer->nama }}">

            <label>Department:</label>
            <input type="text" name="department" value="{{ $lecturer->department }}">

            <label>Phone Number:</label>
            <input type="text" name="phone" value="{{ $lecturer->phone }}">

            <label>Email:</label>
            <input type="email" name="email" value="{{ $lecturer->email }}">

            <label>Change Profile Picture:</label>
            <input type="file" name="image">

            <div class="modal-actions">
                <button type="button" onclick="closeModal()" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>

        </form>
    </div>
</div>

<script>
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