<?php

namespace App\Http\Controllers;

use App\Deduction;
use App\Payroll;
use Illuminate\Http\Request;

class DeductionController extends Controller
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
     * @param string payroll_code
     * @param string employee_id
     * @return \Illuminate\Http\Response
     */
    public function index($payroll_code, $employee_id)
    {
        $payslip = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->first();
        
        return view('deduction.index', compact('payslip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string payroll_code
     * @param string employee_id
     * @return \Illuminate\Http\Response
     */
    public function create($payroll_code, $employee_id)
    {
        $payslip = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->first();
        $deduction = new Deduction();
        $deduction->type = 0;
        return view('deduction.create', compact('payslip', 'deduction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest();
        // dd($data);
        $deduction = Deduction::create($data['deductionData']);
        Payroll::where(['payroll_code' => $data['payroll_code'], 'employee_id' => $data['employee_id']])->first()->deductions()->attach($deduction);
        return redirect('/deduction/'.$data['payroll_code'] .'/'.$data['employee_id'] )->with('alert', $data['deductionData']['name'] . ' has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        $payslip = $deduction->payrolls[0];
        return view('deduction.edit', compact('deduction' ,'payslip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        $data = $this->validateRequest();
        // dd($data);

        $deduction->update($data['deductionData']);

        return redirect('/deduction/'.$data['payroll_code'] .'/'.$data['employee_id'] )->with('alert', $data['deductionData']['name'] . ' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        //
    }

    public function validateRequest() {
        $data = request()->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|numeric',
            'payroll_code' => '',
            'employee_id' => '',
        ]);

        $data['name'] = ucwords(strtolower($data['name']));

        $payroll_code = $data['payroll_code'];
        $employee_id = $data['employee_id'];
        unset($data['payroll_code']);
        unset($data['employee_id']);

        return array(
            'deductionData' => $data,
            'payroll_code' => $payroll_code,
            'employee_id' => $employee_id
        );
    }
}
