<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function salary(Request $request)
    {
        $request->validate([
            'search' => ['required', 'integer']
        ]);

        $employee = Employee::where('ecnum', $request->search)->first();
        if(is_null($employee))
        {
            return redirect()->back()->with('error', 'Employee not found');
        }
    }
}
