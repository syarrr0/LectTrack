<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Http\Controllers\Controller;

class IndexadminController extends Controller
{
    public function index()
    {
        
        $inCollege = Attendance::where('selection', 'PROGRAM')->count();

       
        $sickLeave = Attendance::where('selection', 'CUTI')->count();

        $outsideDuty = Attendance::whereIn('selection', ['KURSUS', 'BENGKEL'])->count();

        return view('admin.Dashboard', compact('inCollege', 'sickLeave', 'outsideDuty'));
    }
    
}

?>