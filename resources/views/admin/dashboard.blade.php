<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LectTrack Admin | Dashboard</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

  <style>
    body {
        font-family: 'Inter', sans-serif;
        /* background-color: #f3f4f6;  */
        /* Guna gambar yang sama atau gambar cerah */
        background-image: url("{{ asset('images/kvbpSign.jpg') }}"); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    /* Overlay Putih (Cerah) - Kurangkan gelap */
    body::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.15); /* Transparency 75% putih */
        backdrop-filter: blur(4px); /* Blur sikit */
        z-index: -1;
    }

    /* Card Glass Effect untuk Light Mode */
    .stat-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #3b82f6;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .stat-label {
        color: #64748b; /* Slate 500 */
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-value {
        color: #1e293b; /* Slate 800 */
        font-size: 2.25rem;
        font-weight: 800;
        margin-top: 4px;
    }

    /* Button Styles */
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-primary-glass {
        background: #2563eb;
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    .btn-primary-glass:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
    }

    .btn-outline-glass {
        background: white;
        border: 2px solid #e2e8f0;
        color: #475569;
    }
    .btn-outline-glass:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
        transform: translateY(-2px);
    }

  
  </style>
</head>
<body class="min-h-screen text-slate-800">

<header class="fixed top-0 left-0 w-full z-50 px-4 md:px-8 py-3 bg-sky-100/85 backdrop-blur-md border-b border-sky-200/50 shadow-sm transition-all duration-300">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">
    
    <div class="flex items-center gap-4">
        <img src="{{ asset('images/logo1.png') }}" alt="LectTrack" class="h-8 md:h-10"> 
    </div>
    
    <div class="flex items-center gap-2 md:gap-3 w-full md:w-auto justify-center md:justify-end">
      
      <a href="{{ route('admin.notifications.index') }}" class="flex-1 md:flex-none justify-center bg-white/60 hover:bg-white text-blue-600 border border-blue-200 hover:border-blue-300 px-4 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2 shadow-sm">
        <i data-lucide="bell-ring" class="w-4 h-4"></i> 
        <span class="hidden sm:inline">Notifications</span>
      </a>

      <button onclick="confirmLogout()" class="flex-1 md:flex-none justify-center bg-white/60 hover:bg-red-50 text-red-600 border border-red-200 hover:border-red-300 px-4 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2 shadow-sm">
        <i data-lucide="log-out" class="w-4 h-4"></i> 
        <span class="hidden sm:inline">Sign Out</span>
        <span class="inline sm:hidden">Exit</span>
      </button>

    </div>
  </div>
</header>

<main class="pt-36 pb-20 px-4 md:px-8">
  
  <section class="max-w-7xl mx-auto mb-10 md:mb-12 text-center md:text-left">
    <div class="welcome-box">
      <div class="relative z-10">
        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/30">System Active</span>
        
        <h2 class="text-3xl md:text-5xl font-black text-slate-900 mt-4 md:mt-6 mb-3 md:mb-4">Admin Dashboard</h2>
        
       <p class="text-black font-medium text-base md:text-lg max-w-2xl mb-8 leading-relaxed mx-auto md:mx-0">
    Welcome back! Monitor your staff movements and college attendance statistics from this central command panel.
</p>
        
        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
          <a href="{{ route('admin.index') }}" class="btn-action btn-primary-glass">
            <i data-lucide="users-round" class="w-5 h-5"></i>
            Lecturer List
          </a>
          <a href="{{ route('admin.report') }}" class="btn-action btn-outline-glass">
            <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
            Analytics Report
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-12">
    
    <a href="{{ route('admin.index') }}" class="stat-card block hover:ring-2 hover:ring-blue-400 cursor-pointer">
        <div class="icon-box bg-blue-100 text-blue-600"><i data-lucide="users"></i></div>
        <p class="stat-label">Total Staff Record</p>
        <p class="stat-value counter" data-target="{{ $totalLecturers }}">0</p>
    </a>

    <a href="{{ route('admin.in_college.list') }}" class="stat-card block hover:ring-2 hover:ring-green-400 cursor-pointer">
        <div class="icon-box bg-green-100 text-green-600"><i data-lucide="map-pin"></i></div>
        <p class="stat-label">In College Today</p>
        <p class="stat-value counter" data-target="{{ $inCollege }}">0</p>
    </a>

    <a href="{{ route('admin.leave_list') }}" class="stat-card block hover:ring-2 hover:ring-red-400 cursor-pointer">
        <div class="icon-box bg-red-100 text-red-600"><i data-lucide="calendar-off"></i></div>
        <p class="stat-label">On Leave Today</p>
        <p class="stat-value counter" data-target="{{ $sickLeave }}">0</p>
    </a>

    <a href="{{ route('admin.duty_list') }}" class="stat-card block hover:ring-2 hover:ring-indigo-400 cursor-pointer">
        <div class="icon-box bg-indigo-100 text-indigo-600">
            <i data-lucide="briefcase"></i>
        </div>
        <p class="stat-label">Official Duty Today</p>
        <p class="stat-value counter text-indigo-600" data-target="{{ $outsideDuty ?? 0 }}">0</p>
    </a>
    
  </section>
</main>

<footer class="w-full bg-white/60 backdrop-blur-md border-t border-slate-200 mt-auto">
    <div class="max-w-7xl mx-auto px-8 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo1.png') }}" class="h-6 md:h-8 opacity-80">
            <p class="text-xs md:text-sm font-semibold text-slate-500">© 2025 LectTrack System.</p>
        </div>
        
        <div class="text-slate-400 text-[10px] md:text-xs font-medium">
            Version 2.0.4
        </div>
    </div>
</footer>

<script>
  // Initialize Icons
  lucide.createIcons();
  
  // Animation Counter Logic
  document.querySelectorAll('.counter').forEach(counter => {
    const target = +counter.getAttribute('data-target');
    const updateCount = () => {
      const current = +counter.innerText;
      // Laju sikit animation
      const increment = Math.max(1, Math.ceil(target / 20)); 
      if(current < target) {
        counter.innerText = current + increment;
        setTimeout(updateCount, 30);
      } else { counter.innerText = target; }
    };
    updateCount();
  });

  // Logout Confirmation SweetAlert
  function confirmLogout() {
    Swal.fire({
        title: 'Sign Out?',
        text: "End your session now?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Yes, Logout',
        // Tukar tema alert jadi cerah
        background: '#ffffff',
        color: '#1e293b' 
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form dynamicaaly
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('logout') }}";
            form.innerHTML = `@csrf`;
            document.body.appendChild(form);
            form.submit();
        }
    });
  }

  /* --- SOUND NOTIFICATION LOGIC --- */
  const sound = new Audio("{{ asset('sounds/notify.wav') }}");
  let audioUnlocked = false;

  // Browser moden block sound autoplay. Kita unlock bila user klik apa-apa 1 kali.
  document.body.addEventListener('click', function() {
      if (!audioUnlocked) {
          sound.play().then(() => {
              sound.pause();
              sound.currentTime = 0;
          }).catch(e => {}); // Ignore error kalau kosong
          audioUnlocked = true;
      }
  }, { once: true });

  let lastData = {
    totalLecturers: {{ $totalLecturers }},
    inCollege: {{ $inCollege }},
    sickLeave: {{ $sickLeave }},
    outsideDuty: {{ $outsideDuty ?? 0 }},
  };

  function updateCounterRealtime(element, newValue) {
    element.innerText = newValue;
    // Boleh tambah highlight effect kalau nak
    element.classList.add('text-blue-600'); 
    setTimeout(() => element.classList.remove('text-blue-600'), 1000);
  }

  // Poll data setiap 5 saat
  setInterval(() => {
    // Pastikan route ni wujud dalam web.php
    fetch('/admin/dashboard/realtime')
      .then(res => {
          if (!res.ok) throw new Error('Network response was not ok');
          return res.json();
      })
      .then(data => {
        let hasNewData = false;

        // Compare data
        for (let key in data) {
          if (data[key] > lastData[key]) {
            hasNewData = true;
          }
        }

        // Kalau ada perubahan, bunyikan loceng
        if (hasNewData && audioUnlocked) {
          sound.play().catch(error => console.log('Audio blocked:', error));
        }

        // Update DOM
        document.querySelectorAll('.counter').forEach(el => {
          const label = el.previousElementSibling.innerText;
          // Pastikan label match dengan HTML di atas
          if (label === 'TOTAL STAFF RECORD') updateCounterRealtime(el, data.totalLecturers);
          if (label === 'IN COLLEGE TODAY') updateCounterRealtime(el, data.inCollege);
          if (label === 'ON LEAVE TODAY') updateCounterRealtime(el, data.sickLeave);
          if (label === 'OFFICIAL DUTY TODAY') updateCounterRealtime(el, data.outsideDuty);
        });

        lastData = data;
      })
      .catch(err => console.error('Error fetching realtime data:', err));
  }, 5000); // 5 saat
</script>
</body>
</html>