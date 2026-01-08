
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
let isActionRunning = false; // Kunci untuk menghalang pertembungan data

function loadNotifications() {
    if (isActionRunning) return; // Jika tengah klik clear/read, jangan tarik data

    fetch('/api/notifications/fetch')
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById('dynamicNotifList');
            const badge = document.getElementById('notifBadge');

            // 1. Update Badge
            if (data.unreadCount > 0) {
                badge.innerText = data.unreadCount;
                badge.style.display = 'block';
            } else {
                badge.style.display = 'none';
            }

            // 2. Render List
            list.innerHTML = '';
            if (data.notifications.length === 0) {
                list.innerHTML = '<li style="padding:10px; color:#888;">No notifications</li>';
            } else {
                data.notifications.forEach(item => {
                    const li = document.createElement('li');
                    li.style.opacity = item.is_read == 1 ? '0.5' : '1'; 
                    li.innerHTML = `
                        <div style="padding: 10px; border-bottom: 1px solid #eee;">
                            <strong style="color: ${item.is_read == 1 ? '#666' : '#000'}">📌 ${item.title}</strong>
                            <p style="font-size: 13px; margin: 5px 0;">${item.content}</p>
                            <small style="color: #bbb;">${item.date}</small>
                        </div>
                    `;
                    list.appendChild(li);
                });
            }
        });
}

function handleBellClick() {
    isActionRunning = true; // Kunci setInterval
    fetch('/api/notifications/mark-read', {
        method: 'POST',
        headers: { 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(() => {
        isActionRunning = false; // Buka kunci
        loadNotifications(); // Paksa refresh data terkini
    })
    .catch(() => isActionRunning = false);
}

function clearAll() {
    if(!confirm("Padam semua notifikasi?")) return;

    // Sembunyikan terus secara visual supaya user nampak "instant"
    document.getElementById('dynamicNotifList').innerHTML = '<li>Memadam...</li>';
    document.getElementById('notifBadge').style.display = 'none';

    fetch('/api/notifications/clear-all', {
        method: 'POST',
        headers: { 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        console.log("Berjaya padam");
        loadNotifications(); // Tarik balik data yang dah kosong
    })
    .catch(err => console.error("Error:", err));
}

// Jalankan load pertama kali
loadNotifications();
// Jalankan setiap 10 saat
setInterval(loadNotifications, 100);
