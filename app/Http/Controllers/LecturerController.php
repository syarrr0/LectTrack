<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class LecturerController extends Controller
{
    /* ================================
       Email API (Node.js)
    =================================*/
private function sendEmail($to, $subject, $html)
{
    try {
        Mail::send([], [], function ($message) use ($to, $subject, $html) {
            $message->to($to)
                    ->subject($subject)
                    ->html($html); // FIX: Laravel 10+ guna html() bukan setBody()
        });

        return [
            'success' => true
        ];

    } catch (\Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

    /* ================================
       SIGNUP
    =================================*/
    public function showSignup()
    {
        return view('signUp');
    }

    public function processSignup(Request $request)
    {
        $request->validate([
            'nama'       => 'required|max:100',
            'department' => 'required|max:100',
            'email'      => 'required|email|max:150|unique:lecturers,email',
            'password'   => 'required|min:6'
        ]);

        DB::table('lecturers')->insert([
            'nama'       => $request->nama,
            'department' => $request->department,
            'email'      => $request->email,
            'password'   => $request->password

        ]);

        return redirect()->route('signup')->with('success', 'Pendaftaran berjaya!');
    }

    /* ================================
       LOGIN
    =================================*/
    public function login(Request $request)
    {
        $lecturer = DB::table('lecturers')
            ->where('nama', $request->nama)
            ->where('department', $request->department)
            ->first();

       if (!$lecturer || $request->password !== $lecturer->password) {
    return back()->withErrors(['Login gagal. Maklumat tidak sah.']);
}


        session([
            'lecturer_id' => $lecturer->id,
            'lecturer'    => $lecturer
        ]);

        return redirect()->route('home.user');
    }

    /* ================================
       LOGOUT
    =================================*/
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    /* ================================
       PROFILE
    =================================*/
    public function showInformation()
    {
        $lecturer = DB::table('lecturers')
            ->where('id', session('lecturer_id'))
            ->first();

        return view('information', compact('lecturer'));
    }

    public function editInformation()
    {
        $lecturer = DB::table('lecturers')
            ->where('id', session('lecturer_id'))
            ->first();

        return view('edit_information', compact('lecturer'));
    }

    public function updateInformation(Request $request)
    {
        $id = session('lecturer_id');

        $imageName = DB::table('lecturers')->where('id', $id)->value('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $imageName);
        }

        DB::table('lecturers')
            ->where('id', $id)
            ->update([
                'nama'       => $request->nama,
                'department' => $request->department,
                'identity'   => $request->identity,
                'phone'      => $request->phone,
                'email'      => $request->email,
                'image'      => $imageName
            ]);

        return redirect()->route('lecturer.information')
                         ->with('success', 'Maklumat berjaya dikemaskini!');
    }

    /* =============================================
       FORGOT PASSWORD
    =============================================*/
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $lecturer = DB::table('lecturers')->where('email', $request->email)->first();

        if (!$lecturer) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $resetLink = url('/reset-password/'.$token);

        // HANTAR EMAIL
        $this->sendEmail(
            $lecturer->email,
            "Reset Your Password",
            "<p>Click the link below to reset your password:</p>
             <a href='{$resetLink}'>{$resetLink}</a>"
        );

        return back()->with('success', 'Reset link has been sent to your email.');
    }

    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'password' => 'required|min:6'
        ]);

        $record = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        DB::table('lecturers')->where('email', $record->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets')->where('email', $record->email)->delete();

        return redirect('/')->with('success', 'Password updated successfully!');
    }

    /* =============================================
       CHANGE PASSWORD VIA TOKEN
    =============================================*/
    public function sendChangePasswordLink(Request $request)
    {
        if (!session('lecturer_id')) {
            return back()->with('error', 'User not logged in.');
        }

        $lecturer = DB::table('lecturers')->where('id', session('lecturer_id'))->first();

        if (!$lecturer) {
            return back()->with('error', 'Lecturer not found.');
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $lecturer->email],
            ['token' => $token, 'created_at' => now()]
        );

        $resetLink = url('/user/change-password/' . $token);

        $this->sendEmail(
            $lecturer->email,
            "LectTrack - Change Password",
            "<p>Hi {$lecturer->nama},</p>
             <p>Click the link below to change your password:</p>
             <a href='{$resetLink}'>{$resetLink}</a>"
        );

        return back()->with('success', 'Change Password link sent to your email!');
    }

    public function showChangePasswordForm($token)
    {
        return view('user.change_password', ['token' => $token]);
    }

   public function submitChangePassword(Request $request, $token)
{
    $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $record = DB::table('password_resets')->where('token', $token)->first();

    if (!$record) {
        return back()->with('error', 'Invalid or expired token.');
    }

    DB::table('lecturers')->where('email', $record->email)->update([
        'password' => Hash::make($request->password)
    ]);

    DB::table('password_resets')->where('email', $record->email)->delete();

    return redirect('/')->with('success', 'Password successfully changed.');
}
 public function edit($id)
    {
        $lecturer = Lecturer::findOrFail($id);

        return view('admin.lecturer.edit', compact('lecturer'));
    }
        public function print($id)
    {
        $lecturer = Lecturer::with('latestAttendance')->findOrFail($id);

        return view('admin.lecturer.print', compact('lecturer'));
    }
     public function report($id)
    {
        $lecturer = Lecturer::findOrFail($id);

        $attendances = Attendance::where('lecturer_id', $id)
            ->orderBy('date_submit', 'desc')
            ->get();

        return view('admin.lecturer.report', compact('lecturer', 'attendances'));
    }
public function destroy($id)
    {
        // Padam data dari table lecturers berdasarkan ID
        $deleted = \DB::table('lecturers')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Lecturer deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete data.');
        }
    }
}
