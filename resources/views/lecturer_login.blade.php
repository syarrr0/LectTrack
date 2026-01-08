<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system, "SF Pro Display", "SF Pro Text", Arial, sans-serif;
    }

    /* BODY + Background */
    body{
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
        background-image: url("{{ asset('images/kvbpSign.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    /* Dark overlay (corporate style) */
    body::before{
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 0;
    }

    /* FORM WRAPPER */
    .login-wrapper{
        width: 1000px;
        max-width: 100%;
        height: 520px;
        background: #ffffff;
        border-radius: 18px;
        display: flex;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(0,0,0,0.25);
        z-index: 1;
        animation: fade .6s ease;
    }

    @keyframes fade {
        from {opacity: 0; transform: translateY(25px);}
        to   {opacity: 1; transform: translateY(0);}
    }

    /* LEFT SIDE (Corporate Blue Panel) */
    .left{
        width: 50%;
        padding: 55px 40px;
        background: #0A3D91;   /* Corporate deep blue */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .left-content{
        position: relative;
        z-index: 10;
    }

    /* LOGOS */
    .logo-box{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
        gap: 38px;
    }

    .logo-box img{
        width: 150px;
        filter: drop-shadow(0 2px 6px rgba(0,0,0,0.35));
    }

    /* WELCOME TITLE */
    .left h1{
        font-size: 2.25rem;
        font-weight: 800;
        margin-bottom: 14px;
        letter-spacing: 0.5px;
    }

    /* ANIMATED TEXT */
    #animatedText{
        font-size: 1rem;
        opacity: 0;
        transform: translateY(25px);
        transition: all 0.6s ease;
        line-height: 1.4rem;
        min-height: 55px;
        width: 270px;
        margin: 0 auto;
    }

    .text-visible{
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    /* RIGHT SIDE */
    .right{
        width: 50%;
        padding: 60px 55px;
    }

    .right h2{
        font-size: 1.9rem;
        margin-bottom: 8px;
        color: #0A3D91;
        font-weight: 700;
    }

    .right small{
        display: block;
        margin-bottom: 25px;
        color: #6B7280;
    }

    .input{
        margin-bottom: 18px;
    position: relative;
    }

    .input label{
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #0A3D91;
    }

    .input input{
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        border: 1.6px solid #CED4DA;
        background: #f7f7f7;
        font-size: 15px;
        transition: .2s;
    }

    .input input:focus{
        background: #fff;
        border-color: #0A3D91;
        box-shadow: 0 0 0 3px rgba(10,61,145,0.18);
    }

    /* BUTTON */
    button{
        width: 100%;
        padding: 14px;
        background: #0A3D91;
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
        font-size: 1rem;
        letter-spacing: .3px;
    }

    button:hover{
        background: #0D4CB8;
    }

    /* SIGNUP LINK */
    .forgot-text{
        font-size: 0.9rem;
        margin-top: 6px;
        color: #444;
    }
    .forgot-text a{
        color: #0A3D91;
        text-decoration: none;
        font-weight: 600;
    }
    .forgot-text a:hover{
        text-decoration: underline;
    }

    /* MOBILE RESPONSIVE */
    @media(max-width: 820px){
        .login-wrapper{
            flex-direction: column;
            height: auto;
        }
        .left{
            width: 100%;
            padding: 40px 25px;
        }
        .right{
            width: 100%;
            padding: 40px 25px;
        }
        .logo-box img{
            width: 120px;
        }
        .left h1{
            font-size: 2rem;
        }
    }

    @media(max-width: 500px){
        .logo-box{
            gap: 20px;
        }
        .logo-box img{
            width: 95px;
        }
        .left h1{
            font-size: 1.7rem;
        }
        #animatedText{
            width: 95%;
        }
    }

    .eye-icon{
      position:absolute;
      top:50%;
      right:20px;
      transform:translateY(-50%);
      cursor:pointer;
      color:#6B7280;
      font-size:14px;
      font-weight:600;
    }
</style>
</head>

<body>

<div class="login-wrapper">

    <!-- LEFT SIDE -->
    <div class="left">
        <div class="left-content">

            <div class="logo-box">
                <img src="{{ asset('images/logoKV_white.png') }}">
                <img src="{{ asset('images/logo1_white.png') }}">
            </div>

            <h1>WELCOME</h1>
            <div id="animatedText"></div>
       
                <a href="{{ url('/') }}" class="btn btn-home" style="color:white;">
               </i> Back To Home 
            </a>

        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <h2>Log In</h2>
        <small>Welcome back, please log in first</small>

        <form method="POST" action="{{ route('lecturer.login.submit') }}">
            @csrf

            <div class="input">
                <label>Username</label>
                <input type="text" name="nama" autocomplete="off" required>
            </div>

            <div class="input">
                <label>Department</label>
                <input type="text" name="department" autocomplete="off" required>
            </div>

            <div class="input">
                <label>Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
<span class="eye-icon" onclick="togglePassword()">
    <i id="toggleIcon" class="fa-solid fa-eye"></i>
</span>


                <p class="forgot-text">
                    Create new account
                    <a href="{{ url('signup') }}">Sign Up</a>
                </p>

            </div>

            
            <button type="submit">Log In</button>

        </form>

    </div>
</div>

<!-- TEXT SLIDER JS -->
<script>
    const lines = [
        "Please log in to access your LectTrack dashboard.",
        "If you don't have an account yet, click the 'Sign Up' button.",
        "If you experience login issues, please contact the admin.",
        "Thank you."
    ];

    let index = 0;
    const animatedText = document.getElementById("animatedText");

    function showNextLine() {
        animatedText.classList.remove("text-visible");

        setTimeout(() => {
            animatedText.innerHTML = lines[index];
            animatedText.classList.add("text-visible");

            index = (index + 1) % lines.length;
        }, 400);
    }

    showNextLine();
    setInterval(showNextLine, 3000);

function togglePassword() {
    const pwd = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (pwd.type === "password") {
        pwd.type = "text";
        // Tukar kepada ikon mata tertutup apabila kata laluan dipaparkan
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        pwd.type = "password";
        // Tukar kepada ikon mata terbuka apabila kata laluan disembunyikan
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

</body>
</html>
