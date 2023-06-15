<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees', [
            'employees' => $employees
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'natid' => ['required', 'regex:/^\d{2}-\d{7} [A-Z] \d{2}$/'],
            'address' => ['required'],
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        try{
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('images/known_faces'), $imageName);

            $employee = new Employee();
            $employee->ecnum = rand(2000, 9999);
            $employee->fname = $request->fname;
            $employee->lname = $request->lname;
            $employee->sex = $request->sex;
            $employee->natid = $request->natid;
            $employee->address = $request->address;
            $employee->image = $imageName;
            $employee->save();

            return redirect()->back()->with('success', 'Successfully added new employee.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'employee_id' => ['required', 'integer'],
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'natid' => ['required', 'regex:/^\d{2}-\d{7} [A-Z] \d{2}$/'],
            'address' => ['required'],
        ]);

        try{
            $employee = Employee::find($request->employee_id);
            $employee->ecnum = rand(2000, 9999);
            $employee->fname = $request->fname;
            $employee->lname = $request->lname;
            $employee->sex = $request->sex;
            $employee->natid = $request->natid;
            $employee->address = $request->address;
            $employee->save();

            return redirect()->back()->with('success', 'Successfully updated employee.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'employee_id' => ['required', 'integer'],
        ]);

        try{
            $employee = Employee::find($request->employee_id);
            if(is_null($employee))
            {
                return redirect()->back()->with('error', 'Employee not found.');
            }
            $employee->delete();

            return redirect()->back()->with('success', 'Successfully updated employee.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }
}
