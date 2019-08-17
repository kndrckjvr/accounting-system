<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Branch;
use Illuminate\Support\Facades\DB;
use App\BasicPay;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = count(Branch::all()) == 0 ? null : Branch::all();
        $employee = new Employee();
        
        return view('employee.create', compact('branches', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        $data['name'] = ucwords(strtolower($data['name']));
        $data['employee_number'] = DB::table('employees')->latest('employee_number')->first() == null ?
            '100' : DB::table('employees')->latest('employee_number')->first()->employee_number + 1;
        $basicPay = $data['basic_pay'];
        unset($data['basic_pay']);

        $data['id'] = Employee::create($data)->id;
        BasicPay::create(['employee_id' => $data['id'], 'amount' => $basicPay]);

        return redirect('/employee')->with('alert', $data['name'] . ' has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        // dd($employee->current_basic_pay());
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $branches = Branch::all()->count() == 0 ? null : Branch::all();
        return view('employee.edit', compact('employee', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $this->validateRequest($request, $employee);
        $data['name'] = ucwords(strtolower($data['name']));
        $basicPay = $data['basic_pay'];
        unset($data['basic_pay']);

        $employee->update($data);
        
        BasicPay::create([
            'employee_id' => $employee->id,
            'amount' => $basicPay
        ]);

        return redirect('/employee')->with('alert', $data['name'] . ' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect('/employee')->with('alert', $employee->name . ' has been deleted.');
    }


    /**
     * Validates the user inputs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return array
     */
    public function validateRequest(Request $request, Employee $employee = null)
    {
        return $request->validate([
            'name' => ($employee == null) ? 'required|unique:employees' : ($request['name'] != $employee->name) ? 'required|unique:employees' : 'required',
            'basic_pay' => 'required|numeric',
            'branch_id' => 'required|numeric'
        ]);
    }
}
