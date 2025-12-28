<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Verification - LectTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --ios-blue: #007AFF;
            --ios-grey: #8E8E93;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --error-red: #FF3B30;
            --success-green: #34C759;
        }

        body {
            font-family: 'Poppins', -apple-system, sans-serif;
            /* Gradient latar belakang yang lembut dan premium */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .ios-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.4);
            text-align: center;
            animation: cardAppear 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .brand-icon {
            background: var(--ios-blue);
            width: 65px;
            height: 65px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 1.6rem;
            box-shadow: 0 8px 20px rgba(0, 122, 255, 0.3);
        }

        h2 {
            font-weight: 600;
            color: #1c1c1e;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .info-box {
            background: rgba(0, 122, 255, 0.08);
            border: 1px solid rgba(0, 122, 255, 0.1);
            padding: 15px;
            border-radius: 16px;
            margin-bottom: 25px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-box i { color: var(--ios-blue); font-size: 1.2rem; }
        .info-box span { font-size: 0.8rem; color: #3a3a3c; line-height: 1.4; }
        .info-box strong { display: block; color: var(--ios-blue); font-size: 0.9rem; }

        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--ios-grey);
            margin-left: 12px;
            margin-bottom: 6px;
            display: block;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ios-grey);
            transition: color 0.3s;
        }

        input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s;
            font-family: inherit;
        }

        input:focus {
            outline: none;
            border-color: var(--ios-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
        }

        input:focus + i { color: var(--ios-blue); }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--ios-blue);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(0, 122, 255, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 122, 255, 0.3);
        }

        .btn-submit:active { transform: scale(0.98); }

        .alert {
            padding: 14px;
            border-radius: 14px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error { background: rgba(255, 59, 48, 0.1); color: var(--error-red); }
        .alert-success { background: rgba(52, 199, 89, 0.1); color: var(--success-green); }

        .footer-link {
            display: block;
            margin-top: 25px;
            font-size: 0.85rem;
            color: var(--ios-grey);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-link:hover { color: var(--ios-blue); }

        /* Mobile Responsive */
        @media (max-width: 480px) {
            .ios-card { border-radius: 0; height: 100vh; max-width: none; padding: 60px 25px; }
            body { background: white; }
        }
    </style>
</head>
<body>

<div class="ios-card">
    <div class="brand-icon">
        <i class="fas fa-shield-alt"></i>
    </div>
    
    <h2>Account Security</h2>
    <p style="color: var(--ios-grey); font-size: 0.9rem; margin-bottom: 25px;">Please verify your identity to proceed.</p>

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="info-box">
        <i class="fas fa-envelope-open-text"></i>
        <span>
            OTP has been sent to:
            <strong>{{ session('target_email') }}</strong>
        </span>
    </div>

    <form action="{{ route('password.update_process') }}" method="POST" id="authForm">
        @csrf
        
        <div class="form-group">
            <label>Verification Code</label>
            <div class="input-wrapper">
                <i class="fas fa-key"></i>
                <input type="text" name="otp" placeholder="Enter 6-digit OTP" maxlength="6" required autocomplete="one-time-code">
            </div>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="new_password" placeholder="Min. 6 characters" required>
            </div>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <div class="input-wrapper">
                <i class="fas fa-check-double"></i>
                <input type="password" name="password_confirmation" placeholder="Repeat new password" required>
            </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">
            Update Password
        </button>
    </form>

    <a href="{{ route('user.home') }}" class="footer-link">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<script>
    // Kesan loading semasa submit
    const form = document.getElementById('authForm');
    const btn = document.getElementById('submitBtn');

    form.onsubmit = function() {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        btn.style.opacity = '0.8';
        btn.style.pointerEvents = 'none';
    };

    // Pastikan input OTP hanya nombor
    const otpInput = document.querySelector('input[name="otp"]');
    otpInput.oninput = function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    };
</script>

</body>
</html>