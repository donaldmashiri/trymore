<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\State;
use Exception;
use PDF;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return view('admin.attendances', [
            'attendances' => $attendances
        ]);
    }

    public function checkin(Request $request)
    {
        try{
            $cmd = 'start cmd /k "python checkin.py"';
            return exec($cmd);
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function checkout(Request $request)
    {
        try{
            $cmd = 'start cmd /k "python checkout.py"';
            return exec($cmd);
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function report(Request $request)
    {
        $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date']
        ]);

        try{
            $data = Attendance::whereBetween('date', [$request->from, $request->to])->get();

            $pdf = PDF::loadView('pdf.report', [
                'attendances' => $data,
                'from' => $request->from,
                'to' => $request->to
            ]);

            return $pdf->download('attendance.pdf');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
