<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LectTrack | Admin Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        /* ===== PAGE BACKGROUND CONTAINER ===== */
        .page-wrapper {
            min-height: 100vh;
            width: 100%;
            background-image: url("{{ asset('images/dewan.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Overlay gelap supaya card jelas */
        .page-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
        }

        /* ===== LOGIN CARD ===== */
        .login-card {
            position: relative;
            z-index: 2;

            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 480px;

            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            transform-style: preserve-3d;
        }

        /* ===== INPUT ===== */
        .login-input {
            border: 1px solid #d1d5db;
            padding: 12px 16px;
            border-radius: 8px;
            background: #f9fafb;
            transition: all 0.2s;
        }

        .login-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            background: #ffffff;
        }

        /* ===== BUTTON ===== */
        .login-btn {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        }

        /* ===== ERROR ===== */
        .error-message {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fca5a5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* ===== LOGO ===== */
        .login-logo {
            display: block;
            margin: 0 auto 16px;
            width: 150px;
            height: auto;
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <div class="login-card" id="loginCard">

        <!-- HEADER -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo1.png') }}"
                 alt="LectTrack Logo"
                 class="login-logo">

            <h2 class="text-3xl font-extrabold text-gray-800">
                Administrator Login
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Access the LectTrack management console
            </p>
        </div>

        <!-- ERROR -->
        @if(session('error'))
            <div class="error-message">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <label class="block mb-4">
                <span class="text-sm font-medium text-gray-700 block mb-1">Username</span>
                <input type="text" name="name" required
                       placeholder="Enter your username"
                       class="login-input block w-full">
            </label>

            <label class="block mb-6">
                <span class="text-sm font-medium text-gray-700 block mb-1">Password</span>
                <input type="password" name="password" required
                       placeholder="Enter your password"
                       class="login-input block w-full">
            </label>

            <button type="submit" class="login-btn w-full">
                <i class="fas fa-sign-in-alt mr-2"></i> Log In
            </button>
        </form>

    </div>

</div>

<!-- ===== TILT EFFECT ===== -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const card = document.getElementById('loginCard');
        const intensity = 8;

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientY - (rect.top + rect.height / 2)) / rect.height;
            const y = (e.clientX - (rect.left + rect.width / 2)) / rect.width;

            card.style.transform =
                `perspective(1000px) rotateX(${x * intensity}deg) rotateY(${-y * intensity}deg)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        });
    });
</script>

</body>
</html>
