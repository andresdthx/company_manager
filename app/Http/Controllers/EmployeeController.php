<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Foundation\Auth\Employee as IlluminateEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objCompanies = new CompanyController();
        $companies = $objCompanies->getCompanies();

        $paginateEmployees = Employee::paginate(10);
        $employees = json_encode($paginateEmployees->items());
        return view('employee.index', compact('employees', 'paginateEmployees', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'phone' => 'required|max:20|min:7',
            'last_name' => 'required|max:20|min:4',
            'first_name' => 'required|max:20|min:3',
            'password' => 'required|max:20|min:6',
            'email' => 'required|max:100|min:10',
        ]);

        $employee = new Employee;
        $employee->last_name = $request->last_name;
        $employee->first_name = $request->first_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->company_id = $request->company_id;
        $employee->save();

        return $employee->first_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'phone' => 'required|max:20|min:7',
            'last_name' => 'required|max:20|min:4',
            'first_name' => 'required|max:20|min:3',
            'password' => 'required|max:20|min:6',
            'email' => 'required|max:100|min:10',
        ]);

        $employee = Employee::find($id[1]);
        $employee->last_name = $request->last_name;
        $employee->first_name = $request->first_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->company_id = $request->company_id;
        $employee->save();

        return $employee->first_name;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('id', '=', $id)->delete();
    }

    public function getEmployees(){
        return Employee::all();
    }
}
