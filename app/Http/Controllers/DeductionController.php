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
        $payslip = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->firstOrFail();

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
        $payslip = Payroll::where(['payroll_code' => $payroll_code, 'employee_id' => $employee_id])->firstOrFail();
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
        Payroll::where(['payroll_code' => $data['payroll_code'], 'employee_id' => $data['employee_id']])->firstOrFail()->deductions()->attach($deduction);
        return redirect('/deduction/' . $data['payroll_code'] . '/' . $data['employee_id'])->with('alert', $data['deductionData']['name'] . ' has been added.');
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
        return view('deduction.edit', compact('deduction', 'payslip'));
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

        return redirect('/deduction/' . $data['payroll_code'] . '/' . $data['employee_id'])->with('alert', $data['deductionData']['name'] . ' has been updated.');
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

    public function validateRequest()
    {
        $data = request()->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|numeric',
            'payroll_code' => '',
            'employee_id' => '',
        ]);

        if ($data['type'] != 2)
            $data['name'] = ucwords(strtolower($data['name']));
        $payroll = Payroll::where(['payroll_code' => $data['payroll_code'], 'employee_id' => $data['employee_id']])->first();
        $basicPay = $payroll->employee->current_basic_pay->amount;
        switch ($data['type']) {
            case "1":
                $taxableAllowance = 0;
                $deductions = 0;

                if (count($payroll->taxable_allowances))
                    foreach ($payroll->taxable_allowances as $allowance)
                        $taxableAllowance += $allowance->amount;

                if (count($payroll->deductions))
                    foreach ($payroll->deductions as $deduction)
                        if ($deduction->type != "Witholding Tax")
                            $deductions += $deduction->amount;

                $witholdingTax = ($basicPay + $taxableAllowance) - ($deductions);

                if ($witholdingTax <= 20833) {
                    $witholdingTax = 0;
                } else if ($witholdingTax > 20833 && $witholdingTax <= 33333) {
                    $witholdingTax = ($witholdingTax - 20833) * 0.2;
                } else if ($witholdingTax > 33333 && $witholdingTax <= 66667) {
                    $witholdingTax = (($witholdingTax - 33333) * 0.25) + 2500;
                } else if ($witholdingTax > 66667 && $witholdingTax <= 166667) {
                    $witholdingTax = (($witholdingTax - 66667) * 0.3) + 10833.33;
                } else if ($witholdingTax > 166667 && $witholdingTax <= 666667) {
                    $witholdingTax = (($witholdingTax - 166667) * 0.32) + 40833.33;
                } else if ($witholdingTax > 666667) {
                    $witholdingTax = (($witholdingTax - 666667) * 0.35) + 208833.33;
                }
                // gawing float yung lahat ng mga amount
                // dd($witholdingTax);
                $data['amount'] = $witholdingTax;
                break;
            case "2":
                if ($basicPay < 2250) {
                    $data['amount'] = 80;
                } else if ($basicPay >= 19750) {
                    $data['amount'] = 800;
                } else {
                    $data['amount'] = round($basicPay / 500) * 20;
                }
                break;
            case "3":
                if ($basicPay <= 10000) {
                    $data['amount'] = 137.5;
                } else if ($basicPay >= 40000) {
                    $data['amount'] = 550;
                } else {
                    $data['amount'] = ($basicPay * 0.0275) / 2;
                }
                break;
            case "4":
                if ($basicPay > 5000) {
                    $data['amount'] = 100;
                } else if ($basicPay >= 1500) {
                    $data['amount'] = $basicPay * 0.02;
                } else if ($basicPay < 1500) {
                    $data['amount'] = $basicPay * 0.01;
                }
                break;
            case "5":

                break;
        }

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
