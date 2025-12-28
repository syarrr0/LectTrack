<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - LectTrack</title>

    <!-- iOS Font -->
    <link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    
       body {
            font-family: "SF Pro Display", sans-serif;
            background: url('{{ asset("images/help.jpeg") }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #222;
        }

        /* HEADER */
        .header {
            width: 100%;
            padding: 18px 20px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e3e6f0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header img {
            height: 40px;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
            flex-grow: 1;
            text-align: center;
        }

        .back-btn {
            padding: 8px 16px;
            background: #2e4a8a;
            color: white;
            border-radius: 10px;
            font-size: 13px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            margin-left: auto;
        }

        .back-btn:hover {
            background: #1f3570;
        }

        /* CONTENT */
        .content {
            width: 85%;
            max-width: 1100px;
            margin: 30px auto 60px auto;
            background: rgba(255,255,255,0.75);
            padding: 20px 25px;
            border-radius: 10px;
            backdrop-filter: blur(2px);
        }

        h1, h2, h3 {
            font-weight: 700;
            color: #2b2b2b;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 35px;
            font-size: 22px;
        }

        h3 {
            margin-top: 25px;
            font-size: 18px;
        }

        /* Navigation list */
        .toc a {
            display: block;
            font-size: 16px;
            padding: 6px 0;
            text-decoration: none;
            color: #2e4a8a;
            font-weight: 600;
        }

        .toc a:hover {
            text-decoration: underline;
        }

        /* FAQ TABLE */
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            background: rgba(255,255,255,0.7);
            border-radius: 8px;
            overflow: hidden;
        }

        table td {
            padding: 12px 5px;
            border-bottom: 1px solid #e4e4e4;
        }

        table td:first-child {
            font-weight: 600;
            width: 40%;
            color: #111;
        }

        /* CONTACT BOX */
        .contact-box {
            margin-top: 15px;
            padding: 20px;
            background: rgba(237,241,255,0.85);
            border-radius: 12px;
        }

        .contact-section-title {
            font-weight: 700;
            color: #1b2f70;
            margin-bottom: 6px;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {

            .header {
                padding: 12px 12px;
            }

            .header img {
                height: 35px;
            }

            .header h1 {
                font-size: 18px;
            }

            .back-btn {
                padding: 6px 14px;
                font-size: 12px;
            }

            .content {
                width: 92%;
                margin: 20px auto 40px auto;
                padding: 18px;
            }

            h2 {
                font-size: 20px;
            }

            h3 {
                font-size: 17px;
            }

            /* Table becomes stacked */
            table td {
                display: block;
                width: 100%;
                border-bottom: 1px solid #ccc;
            }

            table td:first-child {
                margin-top: 15px;
                font-size: 15px;
            }

            table td:last-child {
                margin-bottom: 10px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo">
        <h1>Help & Support</h1>
        <a href="{{ url()->previous() }}" class="back-btn">Back</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <h2>1. Quick Navigation</h2>
        <div class="toc">
            <a href="#faq">Frequently Asked Questions (FAQ)</a>
            <a href="#panduan">Step-by-Step Guide</a>
            <a href="#hubungan">Contact Information</a>
        </div>

        <h2 id="faq">2. Frequently Asked Questions (FAQ)</h2>

        <h3>2.1 Account & Login</h3>
        <table>
            <tr>
                <td>How do I log in to the system?</td>
                <td><b>Use your Username, Department, and Password</b> during Sign Up. Recommended browser: Chrome or Edge.</td>
            </tr>
            <tr>
                <td>I forgot my password.</td>
                <td><b>Click the Profile Icon</b> to reset your password.</td>
            </tr>
            <tr>
                <td>I cannot log in.</td>
                <td>Your account might not be activated. <b>Please contact the system administrator.</b></td>
            </tr>
        </table>

        <h3>2.2 Record Attendance</h3>
        <table>
            <tr>
                <td>How do I record attendance?</td>
                <td>Click <b>"RECORD ATTENDANCE"</b>, verify your time & location, then press SUBMIT.</td>
            </tr>
            <tr>
                <td>I forgot to record attendance.</td>
                <td><b>Inform your Head of Department</b> immediately.</td>
            </tr>
            <tr>
                <td>Recording late attendance.</td>
                <td>Attendance follows office hours (<b>8:00 AM – 5:00 PM</b>).</td>
            </tr>
        </table>

        <h3>2.3 Viewing Attendance Data</h3>
        <table>
            <tr>
                <td>How to check past attendance?</td>
                <td>Click <b>"HISTORY ATTENDANCE"</b>, filter by date/month.</td>
            </tr>
            <tr>
                <td>What is inside "View Information"?</td>
                <td>Personal details, department, phone, email & <b>attendance statistics</b>.</td>
            </tr>
            <tr>
                <td>My record has errors.</td>
                <td><b>Contact admin</b> and provide supporting documents.</td>
            </tr>
        </table>

        <h2 id="panduan">3. Step-by-Step Guide</h2>

        <h3>Record Attendance Guide</h3>
        <ol>
            <li><b>Log in</b> to LectTrack</li>
            <li>Select <b>RECORD ATTENDANCE</b></li>
            <li>Choose IN or OUT</li>
            <li>Verify details</li>
            <li>Press <b>SUBMIT</b></li>
        </ol>

        <h3>View Records Guide</h3>
        <ol>
            <li>Click <b>HISTORY ATTENDANCE</b></li>
            <li>Select date/month</li>
            <li>Print or export</li>
        </ol>

        <h2 id="hubungan">4. Contact Information</h2>

        <div class="contact-box">
            <div class="contact-section-title">Technical Support (Login / System)</div>
            Department: IT Unit<br>
            Email: [email protected]<br>
            Phone: +603-xxxx xxxx (ext: 123)<br><br>

            <div class="contact-section-title">Admin Support (Attendance / Leave)</div>
            Department: PSM Unit<br>
            Email: [email protected]<br>
            Phone: +603-xxxx xxxx (ext: 456)
        </div>

    </div>

</body>
</html>
