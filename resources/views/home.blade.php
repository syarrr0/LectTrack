<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LectTrack Portal | Kolej Vokasional</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

  <div class="circle-bg"></div>

  <main class="login-card" data-aos="zoom-in" data-aos-duration="1000">
    <div class="brand-section">
      <img src="{{ asset('images/logo1.png') }}" alt="Logo KV" class="kv-logo" data-aos="fade-down" data-aos-delay="200">
      <div class="brand-divider" data-aos="stretch"></div>
      <h1 data-aos="fade-up" data-aos-delay="400">Welcome</h1>
    </div>

    <p class="subtitle" data-aos="fade-up" data-aos-delay="500">
      Professional monitoring system for lecturer attendance and location tracking.
    </p>

    <nav class="button-group">
      <a href="{{ url('/lecturer/login') }}" class="btn btn-lecturer" data-aos="fade-left" data-aos-delay="600">
        <i data-lucide="user"></i> Lecturer Log In
      </a>
      <!-- <a href="{{ url('/admin/login') }}" class="btn btn-admin" data-aos="fade-left" data-aos-delay="700">
        <i data-lucide="shield-check"></i> Administrative Login
      </a> -->
    </nav>

    <footer class="footer-info" data-aos="fade-up" data-aos-delay="800">
      <p>Kolej Vokasional Balik Pulau &copy; 2025</p>
    </footer>
  </main>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    // 1. Initialize Animasi Kemasukan (AOS)
    AOS.init({
      once: true,
      mirror: false
    });

    // 2. Initialize Ikon Lucide
    lucide.createIcons();

    // 3. Efek Mouse Move (Parallax Ringan)
    document.addEventListener("mousemove", (e) => {
        const card = document.querySelector(".login-card");
        const x = (window.innerWidth / 2 - e.pageX) / 40;
        const y = (window.innerHeight / 2 - e.pageY) / 40;
        card.style.transform = `rotateY(${x}deg) rotateX(${y}deg)`;
    });
  </script>
</body>
</html>