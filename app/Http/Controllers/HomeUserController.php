<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;

class HomeUserController extends Controller
{
    public function index()
    {
        $lecturerID = session('lecturer_id');

        if (!$lecturerID) {
            return redirect()->route('lecturer.login')->with('error', 'Please login first.');
        }

        $lecturer = Lecturer::where('id', $lecturerID)->first();

        if (!$lecturer) {
            return redirect()->route('lecturer.login')->with('error', 'Lecturer not found.');
        }

        return view('HomeUser', [
            'lecturerID'        => $lecturer->id,
            // NOTE: gunakan kolum SQL 'nama'
            'lecturerName'      => $lecturer->nama ?? '',
            'lecturerDepartment'=> $lecturer->department ?? '',
            'lecturerImage'     => $lecturer->image ?? ''  // kolum SQL 'image'
        ]);
    }
}
