<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\Payroll;
use Illuminate\Http\Request;

class AllowanceController extends Controller
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
        $payslip = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->firstOrFail();
        
        return view('allowance.index', compact('payslip'));
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
        $payslip = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->firstOrFail();
        $allowance = new Allowance();
        return view('allowance.create', compact('payslip', 'allowance'));
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
        
        $allowance = Allowance::create($data['allowanceData']);
        return redirect('/allowance/'.$data['payroll_code'] .'/'.$data['employee_id'] )->with('alert', $data['allowanceData']['name'] . ' has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function show(Allowance $allowance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function edit(Allowance $allowance)
    {
        $payslip = $allowance->payroll;
        return view('allowance.edit', compact('allowance' ,'payslip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allowance $allowance)
    {
        $data = $this->validateRequest();
        // dd($data);

        $allowance->update($data['allowanceData']);

        return redirect('/allowance/'.$data['payroll_code'] .'/'.$data['employee_id'] )->with('alert', $data['allowanceData']['name'] . ' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allowance $allowance, $payroll_code, $employee_id)
    {
        $allowance->delete();

        return redirect('/allowance/' . $payroll_code . '/' . $employee_id)->with('alert', $allowance->name . ' has been deleted.');
    }

    public function validateRequest() {
        $data = request()->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'tax_flag' => '',
            'payroll_code' => '',
            'employee_id' => '',
        ]);

        $data['name'] = ucwords(strtolower($data['name']));

        $data['tax_flag'] = (array_key_exists('tax_flag', $data)) ? 1 : 0;

        $payroll_code = $data['payroll_code'];
        $employee_id = $data['employee_id'];
        $data['payroll_id'] = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->first()->id;
        
        $removeData = array('payroll_code', 'employee_id');
        $data = $this->filterData($removeData, $data);

        return array(
            'allowanceData' => $data,
            'payroll_code' => $payroll_code,
            'employee_id' => $employee_id
        );
    }
}
