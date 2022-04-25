<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
   
    public function index()
    {
        $employee_list = Employee::all();

        return response()->json($employee_list,200);
    }

    public function searchEmployee(Request $request)
    {
        $full_name = $request->get('full_name');
        $designation = $request->get('designation');
        $phone = $request->get('phone');
        $searchEmployee = Employee::where('full_name', 'like', '%'.$full_name.'%')
                          ->where('designation', 'like', '%'.$designation.'%')
                          ->where('phone', 'like', '%'.$phone.'%')
                          ->get();

        return response()->json($searchEmployee,200);
    }

    
    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required|max:191',
            'email' => 'required|email',
            'phone' => 'required',
            'designation' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()],422);
        }else{
            Employee::create($request->all());
            return response()->json('Employee Added Successfully',201);
        }

        
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show(Employee $employee, $id)
    {
        $employee = Employee::where('id', $id)->first();

        return response()->json($employee,200);
    }

    
    public function edit(Employee $employee)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(),[
            'full_name' => 'required|max:191',
            'email' => 'required|email',
            'phone' => 'required',
            'designation' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }else{
            $update = Employee::where('id', $id)->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'designation' => $request->designation,
                'loans' => $request->loans,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'address' => $request->address,
                'photo' => $request->photo,
                'status' => $request->status,
            ]);
            return response()->json($update, 201);
        }
    }

    public function destroy(Employee $employee, $id)
    {
        $delete_employee = Employee::destroy(array('id',$id));

        if($delete_employee){
            return response()->json(201);
        }else{
            return response()->json(["error" => 'Something went Wrong']);
        }
    }
}
