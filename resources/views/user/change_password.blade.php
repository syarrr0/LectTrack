<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - LectTrack</title>

    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f5f7fb;
            padding: 40px;
        }

        .container {
            width: 400px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2b59ff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #1b49e0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom:10px;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red; margin-bottom:10px;">{{ session('error') }}</div>
    @endif

    @if (!isset($token))
        <div style="color:red; font-weight:bold;">
            Invalid request. Please use the link sent to your email.
        </div>
        @php return; @endphp
    @endif

    <form action="{{ route('user.change_password.submit', $token) }}" method="POST">
        @csrf

        <label>New Password</label>
        <input type="password" name="password" required>

        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Update Password</button>
    </form>
</div>


</body>
</html>
