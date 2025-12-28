<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lecturer Sign Up</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    *{
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: -apple-system, "SF Pro Display", "SF Pro Text", Arial, sans-serif;
    }

    body{
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url('{{ asset("images/bgdewan.jpeg") }}') center/cover no-repeat fixed;
      position: relative;
      padding: 15px;
    }

    /* Dark overlay */
    body::before{
      content:"";
      position:absolute;
      inset:0;
      background:rgba(0,0,0,0.45);
      z-index:0;
    }

    /* MAIN WRAPPER */
    .signup-container{
      position:relative;
      z-index:1;
      width: 900px;
      max-width: 100%;
      background:white;
      display:flex;
      border-radius:18px;
      overflow:hidden;
      box-shadow:0 18px 45px rgba(0,0,0,0.25);
      animation: fade .6s ease;
    }

    @keyframes fade{
      from{opacity:0; transform:translateY(25px);}
      to{opacity:1; transform:translateY(0);}
    }

    /* LEFT PANEL - CORPORATE BLUE */
    .signup-image{
      width:50%;
      background:#0A3D91;
      display:flex;
      flex-direction:column;
      justify-content:center;
      align-items:center;
      padding:35px;
      text-align:center;
      color:white;
    }

    .signup-image img{
      width:170px;
      margin-bottom:25px;
      filter: drop-shadow(0 2px 6px rgba(0,0,0,0.35));
    }

    /* RIGHT PANEL */
    .signup-form{
      width:50%;
      padding:60px 45px;
    }

    .signup-form h2{
      font-size: 1.9rem;
      color:#0A3D91;
      font-weight:700;
      margin-bottom:12px;
    }

    .signup-form small{
      display:block;
      margin-bottom:25px;
      color:#6B7280;
    }

    .input-box{
      width:100%;
      margin-bottom:18px;
    }

    .input-box input{
      width:100%;
      padding:14px 18px;
      border-radius:10px;
      border:1.4px solid #CED4DA;
      background:#f7f7f7;
      font-size:14.5px;
      transition:.25s;
    }

    .input-box input:focus{
      background:white;
      border-color:#0A3D91;
      box-shadow:0 0 0 3px rgba(10,61,145,0.18);
    }

    /* PASSWORD SHOW */
    .password-wrapper{ position:relative; }
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

    /* BUTTON */
    .signup-btn{
      width:100%;
      padding:14px;
      background:#0A3D91;
      border:none;
      border-radius:12px;
      color:white;
      font-weight:600;
      font-size:1rem;
      cursor:pointer;
      letter-spacing:.3px;
      transition:.25s;
      margin-top:8px;
    }

    .signup-btn:hover{
      background:#0D4CB8;
    }

    /* BACK TO LOGIN */
    .back-login{
      margin-top:22px;
      text-align:center;
      color:#444;
      font-size:14px;
    }
    .back-login a{
      color:#0A3D91;
      font-weight:600;
      text-decoration:none;
    }
    .back-login a:hover{
      text-decoration:underline;
    }

    /* POPUP */
    .popup-bg{
      display:none;
      position:fixed;
      inset:0;
      background:rgba(0,0,0,0.55);
      justify-content:center;
      align-items:center;
      z-index:999;
    }

    .popup-box{
      background:white;
      padding:30px 40px;
      border-radius:12px;
      width:330px;
      text-align:center;
      box-shadow:0 10px 28px rgba(0,0,0,0.25);
    }

    .popup-btn{
      margin-top:20px;
      padding:12px 25px;
      background:#0A3D91;
      color:white;
      border:none;
      border-radius:10px;
      font-weight:600;
      cursor:pointer;
      transition:.25s;
    }

    .popup-btn:hover{
      background:#0D4CB8;
    }

    /* RESPONSIVE */
    @media(max-width:820px){
      .signup-container{
        flex-direction:column;
      }
      .signup-image,
      .signup-form{
        width:100%;
      }
      .signup-form{
        padding:45px 25px;
      }
    }

  </style>
</head>

<body>

<div class="signup-container">

  <!-- LEFT PANEL -->
  <div class="signup-image">
    <img src="{{ asset('images/logoKV_white.png') }}">
    <img src="{{ asset('images/logo1_white.png') }}">
  </div>

  <!-- RIGHT PANEL -->
  <div class="signup-form">

    <h2>Create New Account</h2>
    <small>Please fill in the details below</small>

    @if ($errors->any())
      <div style="color:red; margin-bottom:10px;">{{ $errors->first() }}</div>
    @endif

    <form id="signupForm" method="POST" action="{{ route('signup.process') }}">
      @csrf

      <div class="input-box">
    
    <input type="email" id="email" name="email" required placeholder="Email">
</div>

      <div class="input-box">
        <input type="text" id="nama" name="nama" placeholder="Full Name" required>
      </div>

      <div class="input-box">
        <input type="text" id="department" name="department" placeholder="Department" required>
      </div>

      <div class="input-box password-wrapper">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <span class="eye-icon" onclick="togglePassword()">
    <i id="toggleIcon" class="fa-solid fa-eye"></i>
</span>
      </div>

      <button type="button" class="signup-btn" onclick="openConfirmPopup()">Sign Up</button>

    </form>

    <div class="back-login">
      Already have an account?
      <a href="{{ url('/lecturer/login') }}">Log In</a>
    </div>

  </div>
</div>

<!-- CONFIRMATION POPUP -->
<div class="popup-bg" id="confirmPopup">
  <div class="popup-box">
    <h3>Confirm Your Details</h3>
    <p id="confirmText"></p>
    <button class="popup-btn" onclick="submitSignup()">Confirm</button>
  </div>
</div>

<!-- SUCCESS POPUP -->
@if(session('success'))
<script>
  window.onload = () => document.getElementById('successPopup').style.display = 'flex';
</script>
@endif

<div class="popup-bg" id="successPopup">
  <div class="popup-box">
    <h3>Account Created Successfully!</h3>
    <button class="popup-btn" onclick="window.location.href='{{ url('/lecturer/login') }}'">Go to Login</button>
  </div>
</div>

<script>
function openConfirmPopup() {
    let email = document.getElementById("email").value;
    let nama  = document.getElementById("nama").value;
    let dept  = document.getElementById("department").value;
    let pwd   = document.getElementById("password").value;

    // Validation lengkap
    if (!nama || !dept || !email || !pwd) {
        alert("Please fill all fields first.");
        return;
    }

    // Text dalam popup
    document.getElementById("confirmText").innerHTML =
        `<b>Name:</b> ${nama}<br>
         <b>Department:</b> ${dept}<br>
         <b>Email:</b> ${email}`;

    document.getElementById("confirmPopup").style.display = "flex";
}

function submitSignup() {
    document.getElementById("signupForm").submit();
}

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
