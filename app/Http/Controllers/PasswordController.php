<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    public function requestOTP(Request $request)
{
    $lecturerID = session('lecturer_id');
    $lecturer = Lecturer::find($lecturerID);

    if (!$lecturer || !$lecturer->email) {
        return back()->with('error', 'Email not found in database for this user.');
    }

    $otp = rand(100000, 999999);
    session(['password_otp' => $otp, 'target_email' => $lecturer->email]);

try {
 Mail::send([], [], function ($message) use ($lecturer, $otp) {
    // Sediakan URL untuk kedua-dua logo
    $logoKV = asset('images/logoKV.png');
    $logo1 = asset('images/logo1.png');
    
    $message->to($lecturer->email)
        ->subject('LectTrack: Security Verification Code')
        ->html("
            <div style='font-family: \"Segoe UI\", Helvetica, Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #e1e1e1; border-radius: 12px; overflow: hidden; background-color: #ffffff;'>
                
                <div style='padding: 25px; text-align: center; background-color: #f8f9fa; border-bottom: 1px solid #eeeeee;'>
                    <img src='" . $logoKV . "' alt='KV Logo' style='height: 65px; width: auto; margin: 0 15px; vertical-align: middle;'>
                    <img src='" . $logo1 . "' alt='LectTrack Logo' style='height: 65px; width: auto; margin: 0 15px; vertical-align: middle;'>
                </div>

                <div style='padding: 35px; line-height: 1.6; color: #333333;'>
                    <h2 style='color: #1c1c1e; margin-top: 0; font-size: 22px;'>Security Verification</h2>
                    
                    <p style='margin-bottom: 10px;'>Hello <strong>" . $lecturer->nama . "</strong>,</p>
                    
                    <p>You have requested to change your password for your <strong>LectTrack</strong> account. Please use the following One-Time Password (OTP) to complete the verification process:</p>
                    
                    <div style='background-color: #f2f2f7; border-radius: 12px; padding: 30px; text-align: center; margin: 30px 0; border: 1px dashed #d1d1d6;'>
                        <span style='font-size: 40px; font-weight: bold; letter-spacing: 10px; color: #007AFF;'>" . $otp . "</span>
                    </div>

                    <p style='font-size: 0.9rem; color: #666666;'>For security reasons, this code is valid for <strong>10 minutes</strong> only. If you did not initiate this request, please ignore this email or contact your administrator.</p>
                    
                    <hr style='border: 0; border-top: 1px solid #eeeeee; margin: 30px 0;'>
                    
                    <p style='font-size: 0.85rem; color: #8e8e93; margin-bottom: 0;'>
                        Best regards,<br>
                        <strong>The LectTrack Team</strong><br>
                        Kolej Vokasional Balik Pulau
                    </p>
                </div>

                <div style='padding: 20px; text-align: center; background-color: #f8f9fa; font-size: 11px; color: #aeaeae;'>
                    &copy; " . date('Y') . " LectTrack System | Kolej Vokasional Balik Pulau. All rights reserved.
                </div>
            </div>
        ");
});

    return redirect()->route('password.change_form')->with('success', 'OTP has been sent to your email.');

} catch (\Exception $e) {
    return back()->with('error', 'Mail Error: ' . $e->getMessage());
}
}
    public function showChangeForm()
    {
        if (!session('password_otp')) return redirect()->route('user.home');
        return view('changePassword'); // Pastikan nama fail view anda betul
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($request->otp != session('password_otp')) {
            return back()->with('error', 'The OTP code is incorrect.');
        }

        $lecturer = Lecturer::find(session('lecturer_id'));
        $lecturer->password = $request->password; // Kemaskini password
        $lecturer->save();

        session()->forget(['password_otp', 'target_email']);

        return redirect()->route('user.home')->with('success', 'Password updated successfully!');
    }
}