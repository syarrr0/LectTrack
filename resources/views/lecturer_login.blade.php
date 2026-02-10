<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In - LectTrack</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* RESET & CORE */
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system, "SF Pro Display", "SF Pro Text", "Segoe UI", Roboto, Arial, sans-serif;
    }

    /* BODY + Background */
    body{
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        background-image: url("{{ asset('images/kvbpSign.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    /* Dark overlay */
    body::before{
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 0;
        backdrop-filter: blur(3px); /* Adds a slight blur to background for focus */
    }

    /* FORM WRAPPER */
    .login-wrapper{
        width: 1000px;
        max-width: 100%;
        min-height: 550px;
        background: #ffffff;
        border-radius: 20px;
        display: flex;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        z-index: 1;
        animation: fadeUp .6s ease;
    }

    @keyframes fadeUp {
        from {opacity: 0; transform: translateY(30px);}
        to   {opacity: 1; transform: translateY(0);}
    }

    /* --- LEFT SIDE (Info Panel) --- */
    .left{
        width: 50%;
        padding: 60px 40px;
        background: linear-gradient(135deg, #0A3D91 0%, #062a69 100%); /* Gradient for depth */
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
    }

    .left-content{
        width: 100%;
        max-width: 400px;
        position: relative;
        z-index: 10;
    }

    /* LOGOS */
    .logo-box{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
        gap: 30px;
    }

    .logo-box img{
        height: 40px; /* Fixed height for consistency */
        width: auto;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
        transition: transform 0.3s;
    }
    
    .logo-box img:hover{
        transform: scale(1.05);
    }

    /* WELCOME TITLE */
    .left h1{
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    /* ANIMATED TEXT */
    #animatedText{
        font-size: 1.05rem;
        font-weight: 300;
        opacity: 0;
        transform: translateY(15px);
        transition: all 0.5s ease;
        line-height: 1.6;
        min-height: 60px;
        margin-bottom: 30px;
        color: rgba(255, 255, 255, 0.9);
    }

    .text-visible{
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    /* IMPROVED BACK BUTTON */
    .btn-home {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        border: 2px solid rgba(255,255,255,0.4);
        border-radius: 50px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.05);
    }

    .btn-home:hover {
        background: #ffffff;
        color: #0A3D91;
        border-color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* --- RIGHT SIDE (Form Panel) --- */
    .right{
        width: 50%;
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right h2{
        font-size: 2rem;
        margin-bottom: 5px;
        color: #0A3D91;
        font-weight: 800;
    }

    .right small{
        display: block;
        margin-bottom: 30px;
        color: #6B7280;
        font-size: 0.95rem;
    }

    /* ERROR ALERT */
    .alert-error {
        background-color: #FEF2F2;
        border: 1px solid #F87171;
        color: #991B1B;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .input-group{
        margin-bottom: 20px;
        position: relative;
    }

    .input-group label{
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #374151;
        font-size: 0.9rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper input{
        width: 100%;
        padding: 14px 16px;
        padding-right: 45px; /* Space for eye icon */
        border-radius: 12px;
        border: 1.5px solid #E5E7EB;
        background: #F9FAFB;
        font-size: 15px;
        transition: .2s;
        outline: none;
    }

    .input-wrapper input:focus{
        background: #fff;
        border-color: #0A3D91;
        box-shadow: 0 0 0 4px rgba(10,61,145,0.1);
    }

    .eye-icon{
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #9CA3AF;
        transition: color 0.2s;
    }

    .eye-icon:hover {
        color: #0A3D91;
    }

    /* LOGIN BUTTON */
    .btn-login{
        width: 100%;
        padding: 15px;
        background: #0A3D91;
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 1rem;
        letter-spacing: .5px;
        margin-top: 10px;
    }

    .btn-login:hover{
        background: #0D4CB8;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(10,61,145,0.25);
    }

    /* FOOTER LINK */
    .signup-link{
        font-size: 0.9rem;
        margin-top: 20px;
        color: #4B5563;
        text-align: center;
    }
    .signup-link a{
        color: #0A3D91;
        text-decoration: none;
        font-weight: 700;
        margin-left: 5px;
    }
    .signup-link a:hover{
        text-decoration: underline;
    }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    
    /* Tablet View (Portrait & small Landscape) */
    @media(max-width: 900px){
        .login-wrapper{
            flex-direction: column;
            width: 550px; /* Slimmer for tablet vertical */
            height: auto;
        }
        .left, .right{
            width: 100%;
        }
        .left{
            padding: 40px 30px;
        }
        .logo-box img{
            height: 60px;
        }
    }

    /* Mobile View */
    @media(max-width: 500px){
        .login-wrapper{
            width: 100%;
            border-radius: 15px;
        }
        .left{
            padding: 35px 20px;
        }
        .right{
            padding: 35px 25px;
        }
        .logo-box{
            gap: 15px;
        }
        .logo-box img{
            height: 50px;
        }
        .left h1{
            font-size: 1.8rem;
        }
        .right h2{
            font-size: 1.6rem;
        }
        #animatedText{
            font-size: 0.95rem;
            min-height: 50px;
        }
    }
</style>
</head>

<body>

<div class="login-wrapper">

    <div class="left">
        <div class="left-content">
            <div class="logo-box">
                <img src="{{ asset('images/logoKV_white.png') }}" alt="Logo KV">
                <img src="{{ asset('images/logo1_white.png') }}" alt="Logo App">
            </div>

            <h1>WELCOME</h1>
            <div id="animatedText"></div>
            
            <a href="{{ url('/') }}" class="btn-home">
                <i class="fa-solid fa-arrow-left"></i> Back To Home 
            </a>
        </div>
    </div>

    <div class="right">

        <h2>Log In</h2>
        <small>Welcome back! Please enter your details.</small>

        @if ($errors->has('login_error'))
        <div class="alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first('login_error') }}</span>
        </div>
        @endif
        <form method="POST" action="{{ route('lecturer.login.submit') }}">
            @csrf

            <div class="input-group">
                <label for="nama">Username</label>
                <div class="input-wrapper">
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                           placeholder="Enter your username" autocomplete="off" required>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" 
                           placeholder="••••••••" required>
                    <span class="eye-icon" onclick="togglePassword()">
                        <i id="toggleIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-login">Log In</button>

            <p class="signup-link">
                Don't have an account? 
                <a href="{{ url('signup') }}">Sign Up</a>
            </p>

        </form>
    </div>
</div>

<script>
    // 1. Text Slider Logic
    const lines = [
        "Please log in to access your LectTrack dashboard.",
        "Manage your schedule and profile easily.",
        "If you experience login issues, please contact admin.",
        "Simplifying Lecturer Management."
    ];

    let index = 0;
    const animatedText = document.getElementById("animatedText");

    // Initialize first line immediately
    if(animatedText) {
        animatedText.innerText = lines[0];
        animatedText.classList.add("text-visible");
    }

    function showNextLine() {
        if(!animatedText) return;
        
        animatedText.classList.remove("text-visible");

        setTimeout(() => {
            index = (index + 1) % lines.length;
            animatedText.innerHTML = lines[index];
            animatedText.classList.add("text-visible");
        }, 500); // Wait for fade out
    }

    // Change text every 4 seconds
    setInterval(showNextLine, 4000);

    // 2. Password Toggle Logic
    function togglePassword() {
        const pwd = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");

        if (pwd.type === "password") {
            pwd.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            pwd.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>