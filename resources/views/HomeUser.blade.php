<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>LectTrack - Home</title>
<link rel="stylesheet" href="{{ asset('css/homeuser.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<video autoplay loop muted playsinline id="bg-video">
    <source src="{{ asset('images/bgg.mp4') }}" type="video/mp4">
</video>

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
        <a href="#" style="display:block;text-align:center;margin-top:6px;color:var(--blue);text-decoration:none;">View All</a>
    </div>
</div>

        <!-- logout -->
        <button id="logout-btn">Log Out</button>
    </div>
</header>

<div class="main-content">
    <img src="{{ asset('images/logoKV.png') }}" style="width:180px;">
    <h1 style="font-size:34px;font-weight:800;margin-top:20px;">WELCOME TO LECTTRACK</h1>
    <p style="font-size:16px;color:#444;margin-top:-5px;">Lecturer attendance management system for professional institutions</p>

    <div class="button-group">
        <a href="{{ route('attendance.form') }}" class="button">RECORD ATTENDANCE</a>
        <a href="{{ route('attendance.history', $lecturerID) }}" class="button">HISTORY ATTENDANCE</a>
        <a href="{{ route('lecturer.information') }}" class="button">VIEW INFORMATION</a>
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
        <input type="text" id="chat-input" placeholder="Tanya soalan anda..." autocomplete="off">
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
            <a href="#">Support</a>
            <a href="#">System Guide</a>
            <a href="#">Account Settings</a>
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

<script>
/* LOGOUT MODAL */
const logoutBtn = document.getElementById("logout-btn");
const logoutModal = document.getElementById("logoutModal");
const cancelLogout = document.getElementById("cancelLogout");

logoutBtn.addEventListener("click", () => logoutModal.style.display = "flex");
cancelLogout.addEventListener("click", () => logoutModal.style.display = "none");

/* PROFILE DROPDOWN */
const profileIcon = document.getElementById("profileIcon");
const profileDropdown = document.getElementById("profileDropdown");

profileIcon.addEventListener("click", function (e) {
    e.stopPropagation();
    profileDropdown.style.display = profileDropdown.style.display === "block" ? "none" : "block";
});
profileDropdown.addEventListener("click", e => e.stopPropagation());
document.addEventListener("click", () => profileDropdown.style.display = "none");

/* NOTIFICATION DROPDOWN */
const notifIcon = document.getElementById("notifIcon");
const notifDropdown = document.getElementById("notifDropdown");

notifIcon.addEventListener("click", function (e) {
    e.stopPropagation();
    notifDropdown.style.display = notifDropdown.style.display === "block" ? "none" : "block";
    document.getElementById("notifBadge").style.display = "none";
});
notifDropdown.addEventListener("click", e => e.stopPropagation());
document.addEventListener("click", () => notifDropdown.style.display = "none");

// UNTUK AI
// Constants dan DOM References
    const chatlog = document.getElementById("chat-log");
    const chatbox = document.getElementById("ai-chatbox");
    const langSelectDiv = document.getElementById("language-selection");
    const chatInput = document.getElementById("chat-input");
    const chatSendBtn = document.getElementById("chat-send-btn");
    
    // Dapatkan pilihan bahasa yang disimpan
    const savedLang = localStorage.getItem('lecttrack_lang');

    // 1. Logik Membuka Chatbot
    document.getElementById("ai-btn").onclick = () => {
        chatbox.classList.toggle("open");
        
        if (chatbox.classList.contains("open")) {
            // Jika bahasa sudah dipilih, sembunyikan butang bahasa
            if (savedLang) {
                langSelectDiv.style.display = 'none';
                startChatSession(savedLang); 
            } else {
                // Jika belum, tunjukkan pilihan bahasa dan kosongkan log
                langSelectDiv.style.display = 'block';
                chatlog.innerHTML = ''; 
                // Sembunyikan input sehingga bahasa dipilih
                document.getElementById("chat-input-box").style.display = 'none'; 
            }
        }
    };

    // 2. Logik Pilihan Bahasa
    document.getElementById("lang-my").onclick = () => selectLanguage('my');
    document.getElementById("lang-en").onclick = () => selectLanguage('en');

    function selectLanguage(lang) {
        localStorage.setItem('lecttrack_lang', lang); // Simpan pilihan
        langSelectDiv.style.display = 'none'; // Sembunyikan butang
        startChatSession(lang); // Mula sesi
    }

    // 3. Fungsi Mula Sesi (Memuatkan mesej alu-aluan)
    function startChatSession(lang) {
        // Tunjukkan input box
        document.getElementById("chat-input-box").style.display = 'flex';
        
        // Hanya hantar mesej alu-aluan jika log sembang kosong
        if (chatlog.innerHTML.trim() === '') {
            // Mesej placeholder yang akan ditangkap oleh AIChatController
            sendMessage("START_SESSION_HELLO", lang);
        }
    }
    
    // 4. Handler untuk Butang Hantar dan Enter
    chatSendBtn.onclick = handleSend;
    chatInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Elak form submit
            handleSend();
        }
    });

    function handleSend() {
        // Ambil bahasa semasa dari local storage (default ke 'my' jika tiada)
        const lang = localStorage.getItem('lecttrack_lang') || 'my'; 
        const msg = chatInput.value.trim();
        if (!msg) return;

        sendMessage(msg, lang);
    }

    function sendMessage(msg, lang) {
        // Hanya paparkan mesej pengguna jika ia bukan mesej sistem
        if (msg !== "START_SESSION_HELLO") {
            // show user message
            chatlog.innerHTML += `<div class="msg user">${msg}</div>`;
            chatInput.value = "";
        }
        
        scrollToBottom();
        showTyping();

        // Send to backend (Termasuk pembetulan CSRF dan URL yang betul: /ai/chat)
        fetch("/ai/chat", { 
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                // Hantar CSRF Token untuk mengelakkan ralat 419
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: msg, lang: lang }), // HANTAR PILIHAN BAHASA
        })
        .then(res => res.json())
        .then(data => {
            removeTyping();
            // typing effect for AI response
            typeText(data.reply);
        })
        .catch(error => {
            removeTyping();
            console.error('Fetch Error:', error);
            const errorMsg = lang === 'en' ? 'Error: Failed to communicate with the server. Please check your connection.' : 'Ralat: Gagal berkomunikasi dengan pelayan. Sila cuba lagi.';
            typeText(errorMsg);
        });
    }

    
    // UTILITY FUNCTIONS (Dikekalkan dari kod asal pengguna)
    
    // Typewriter effect
function typeText(text) {
    let div = document.createElement("div");
    div.className = "msg ai";
    chatlog.appendChild(div);

    // Tukar URL markdown [teks](link) kepada HTML <a> tag
    let formattedText = text.replace(/\[([^\]]+)\]\(([^\)]+)\)/g, '<a href="$2" target="_blank" style="color:yellow; text-decoration:underline;">$1</a>');
    
    // Tukar \n kepada <br>
    formattedText = formattedText.replace(/\n/g, "<br>");

    // Jika mahu kesan menaip, gunakan innerHTML secara berperingkat atau terus masukkan
    // Kerana ada tag HTML <a>, lebih selamat masukkan terus atau guna library.
    // Untuk ringkas, kita masukkan terus:
    div.innerHTML = formattedText;
    scrollToBottom();
}

    // Scroll to bottom
    function scrollToBottom() {
        // Pastikan chatlog adalah scrollable element
        chatlog.scrollTop = chatlog.scrollHeight;
    }

    // Typing animation
    function showTyping() {
        removeTyping(); 
        let typing = document.createElement("div");
        typing.id = "typing";
        typing.className = "msg ai";
        typing.innerHTML = "<span></span><span></span><span></span>";
        chatlog.appendChild(typing);
        scrollToBottom();
    }

    function removeTyping() {
        let t = document.getElementById("typing");
        if (t) t.remove();
    }
 
// your code goes here
document.addEventListener("DOMContentLoaded", function() {
    const aiBtn = document.getElementById("ai-btn");
    const chatBox = document.getElementById("ai-chatbox");
    const sendBtn = document.getElementById("chat-send-btn");
    const chatInput = document.getElementById("chat-input");
    const chatLog = document.getElementById("chat-log");

    // Toggle chatbox
    aiBtn.addEventListener("click", function() {
        chatBox.style.display = chatBox.style.display === "flex" ? "none" : "flex";
    });

    // Send message
    sendBtn.addEventListener("click", function() {
        const msgText = chatInput.value.trim();
        if(msgText === "") return;

        const userMsg = document.createElement("div");
        userMsg.className = "msg user";
        userMsg.textContent = msgText;
        chatLog.appendChild(userMsg);

        chatInput.value = "";
        chatLog.scrollTop = chatLog.scrollHeight;

        // Simulate AI response
        setTimeout(() => {
            const aiMsg = document.createElement("div");
            aiMsg.className = "msg ai";
            aiMsg.textContent = "AI says: " + msgText.split("").reverse().join(""); // simple demo
            chatLog.appendChild(aiMsg);
            chatLog.scrollTop = chatLog.scrollHeight;
        }, 800);
    });

    // Enter key sends message
    chatInput.addEventListener("keypress", function(e) {
        if(e.key === "Enter") sendBtn.click();
    });
});

function addMessage(text, sender) {
    // Tukar \n kepada <br>
    const formatted = text.replace(/\n/g, "<br>");

    const msg = document.createElement("div");
    msg.className = "msg " + sender;
    msg.innerHTML = formatted;
    document.getElementById("chat-log").appendChild(msg);
}

document.addEventListener("click", function (event) {
    const aiBtn = document.getElementById("ai-btn");

    // Jika klik bukan dalam chatbox DAN bukan pada button
    if (!chatbox.contains(event.target) && !aiBtn.contains(event.target)) {
        chatbox.classList.remove("open");
        chatbox.style.display = "none";
    }
});

function handlePasswordRequest() {
    console.log("Menghantar borang tukar kata laluan...");
    document.getElementById('changePassForm').submit();
}

function loadNotifications() {
    fetch('/api/notifications/fetch')
        .then(response => response.json())
        .then(data => {
            const list = document.getElementById('dynamicNotifList');
            const badge = document.getElementById('notifBadge');
            
            if (data.length > 0) {
                list.innerHTML = ''; // Clear old data
                badge.innerText = data.length;
                badge.style.display = 'block';

                data.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <div style="margin-bottom: 8px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                            <strong>📌 ${item.title}</strong><br>
                            <small style="color: #888;">${item.day}, ${item.date}</small>
                            <p style="margin: 3px 0; font-size: 13px;">${item.content}</p>
                        </div>
                    `;
                    list.appendChild(li);
                });
            } else {
                list.innerHTML = '<li>No new notifications</li>';
            }
        });
}

// Check for new notifications every 10 seconds (Simulated Real-time)
setInterval(loadNotifications, 10000);

// Initial load
loadNotifications();
</script>


</body>
</html>
