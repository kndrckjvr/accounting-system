<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Employee;
use App\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PayrollController extends Controller
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
        $payrolls = DB::table('payrolls')->groupBy('payroll_code')->get();

        return view('payroll.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suggestStartDate = date('m/d/Y', strtotime(date('m') . "/01/" . date('Y')));
        $suggestEndDate = date('m/d/Y', strtotime($suggestStartDate . " +14 days"));
        $branches = Branch::all();

        if (date('d') > 1) {
            $suggestStartDate = date('m/d/Y', strtotime(date('m') . "/16/" . date('Y')));
            $suggestEndDate = date('m/d/Y', strtotime($suggestStartDate . " +14 days"));
        }

        return view('payroll.create', compact('suggestStartDate', 'suggestEndDate', 'branches'));
    }

    public function generate()
    {

        return view('payroll.generate', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'branch' => 'required'
        ]);

        $branches = $data['branch'] == 0 ? Branch::all() : Branch::find($data['branch']);

        $data['payroll_code'] = Str::random(20);
        $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
        $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));

        if ($data['branch'] == 0) {
            unset($data['branch']);
            foreach ($branches as $branch) {
                foreach ($branch->employees as $employee) {
                    $data['employee_id'] = $employee->id;
                    Payroll::create($data);
                }
            }
        } else {
            unset($data['branch']);
            foreach ($branches->employees as $employee) {
                $data['employee_id'] = $employee->id;
                Payroll::create($data);
            }
        }

        return redirect('/payroll')->with('alert', 'Payroll has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit($payroll)
    {
        $payrolls = Payroll::where('payroll_code', $payroll)->get();

        return view('payroll.edit', compact('payrolls'));
    }

    /**
     * Show the form for editing the payslip.
     *
     * @param  string  $payroll
     * @param  string  $payslip
     * @return \Illuminate\Http\Response
     */
    public function editPaySlip($payroll, $payslip)
    {
        $payslips = Payroll::where(['payroll_code' => $payroll, 'employee_id' => $payslip])->first();
        // dd($payslips);
        return view('payroll.payslip', compact('payslips'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
