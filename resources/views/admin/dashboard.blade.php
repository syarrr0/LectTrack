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
</head>
<body class="min-h-screen">

<header class="fixed top-0 left-0 w-full z-50 px-8 py-4">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="{{ asset('images/logo1_white.png') }}" alt="LectTrack" class="h-10 filter brightness-200">
      <div class="h-6 w-[1px] bg-white/20"></div>
      <span class="text-white font-bold tracking-widest text-xs uppercase">Welcome Back Admin</span>
    </div>
    
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.notifications.index') }}" class="bg-blue-500/20 hover:bg-blue-600 border border-blue-500/50 text-blue-100 hover:text-white px-5 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
        <i data-lucide="bell-ring" class="w-4 h-4"></i> Manage Notifications
      </a>

      <button onclick="confirmLogout()" class="bg-red-500/20 hover:bg-red-500 border border-red-500/50 text-red-200 hover:text-white px-5 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
        <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
      </button>
    </div>
  </div>
</header>

<main class="pt-32 pb-20 px-8">
  
  <section class="max-w-7xl mx-auto mb-12">
    <div class="welcome-box">
      <div class="relative z-10">
        <span class="bg-blue-500/20 text-blue-300 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest border border-blue-500/30">System Active</span>
        <h2 class="text-5xl font-black text-white mt-6 mb-4">Admin Dashboard</h2>
        <p class="text-slate-300 text-lg max-w-2xl mb-10 leading-relaxed">
            Welcome back! Monitor your staff movements and college attendance statistics from this central command panel.
        </p>
        
        <div class="flex flex-wrap gap-5">
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

 <section class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <a href="{{ route('admin.index') }}" class="stat-card block hover:shadow-lg transition-shadow">
        <div class="icon-box bg-blue-100 text-blue-600"><i data-lucide="users"></i></div>
        <p class="stat-label">Total Staff Record</p>
        <p class="stat-value counter" data-target="{{ $totalLecturers }}">0</p>
    </a>

<a href="{{ route('admin.in_college.list') }}" class="stat-card block">
    <div class="icon-box bg-green-100 text-green-600"><i data-lucide="map-pin"></i></div>
    <p class="stat-label">In College Today</p>
    <p class="stat-value counter" data-target="{{ $inCollege }}">0</p>
</a>

   <a href="{{ route('admin.leave_list') }}" class="stat-card group hover:scale-105 transition-transform cursor-pointer">
        <div class="icon-box bg-red-100 text-red-600"><i data-lucide="calendar-off"></i></div>
        <p class="stat-label">On Leave Today</p>
        <p class="stat-value counter" data-target="{{ $sickLeave }}">0</p>
    </a>

<a href="{{ route('admin.duty_list') }}" class="stat-card group hover:scale-[1.02] transition-all cursor-pointer block">
    <div class="icon-box bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
        <i data-lucide="briefcase"></i>
    </div>
    <p class="stat-label">Official Duty Today</p>
    <p class="stat-value counter text-indigo-600" data-target="{{ $outsideDuty ?? 0 }}">0</p>
</a>
    
</section>
</main>

<footer class="w-full bg-white/90 backdrop-blur-md mt-10">
    <div class="max-w-7xl mx-auto px-8 py-10 flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo1.png') }}" class="h-8">
            <p class="text-sm font-semibold text-slate-600">© 2025 LectTrack. High-Performance Management System.</p>
        </div>
        
        <div class="text-slate-400 text-xs font-medium mt-4 md:mt-0">
            System Version 2.0.4
        </div>
    </div>
</footer>

<script>
  lucide.createIcons();
  
  // Animation Counter
  document.querySelectorAll('.counter').forEach(counter => {
    const target = +counter.getAttribute('data-target');
    const updateCount = () => {
      const current = +counter.innerText;
      const increment = Math.max(1, target / 30);
      if(current < target) {
        counter.innerText = Math.ceil(current + increment);
        setTimeout(updateCount, 40);
      } else { counter.innerText = target; }
    };
    updateCount();
  });

  function confirmLogout() {
    Swal.fire({
        title: 'Sign Out?',
        text: "Ending your administrative session now?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#1e293b',
        confirmButtonText: 'Yes, Logout',
        background: '#1e293b',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('logout') }}";
            form.innerHTML = `@csrf`;
            document.body.appendChild(form);
            form.submit();
        }
    });
  }
  const sound = new Audio("{{ asset('sounds/notify.wav') }}");

let lastData = {
  totalLecturers: {{ $totalLecturers }},
  inCollege: {{ $inCollege }},
  sickLeave: {{ $sickLeave }},
  outsideDuty: {{ $outsideDuty }},
};

function updateCounter(element, newValue) {
  const current = parseInt(element.innerText);
  const increment = Math.max(1, Math.floor((newValue - current) / 20));

  if (current < newValue) {
    element.innerText = current + increment;
    setTimeout(() => updateCounter(element, newValue), 50);
  } else {
    element.innerText = newValue;
  }
}

setInterval(() => {
  fetch('/admin/dashboard/realtime')
    .then(res => res.json())
    .then(data => {

      let hasNewData = false;

      for (let key in data) {
        if (data[key] > lastData[key]) {
          hasNewData = true;
        }
      }

      if (hasNewData) {
        sound.play(); // 🔔 BUNYI TING
      }

      document.querySelectorAll('.counter').forEach(el => {
        const label = el.previousElementSibling.innerText;
        if (label === 'Total Lecturers') updateCounter(el, data.totalLecturers);
        if (label === 'In College') updateCounter(el, data.inCollege);
        if (label === 'On Leave') updateCounter(el, data.sickLeave);
        if (label === 'Outside Duty') updateCounter(el, data.outsideDuty);
      });
      lastData = data;
    });
}, 5000);
</script>
</body>
</html>