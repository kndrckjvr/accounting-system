<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payroll;

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
        $payrolls = Payroll::paginate(5);
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

        if (date('d') > 1) {
            $suggestStartDate = date('m/d/Y', strtotime(date('m') . "/16/" . date('Y')));
            $suggestEndDate = date('m/d/Y', strtotime($suggestStartDate . " +14 days"));
        }

        return view('payroll.create', compact('suggestStartDate', 'suggestEndDate'));
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
            'start_date' => 'required|date|unique:payrolls',
            'end_date' => 'required|date|unique:payrolls'
        ]);

        return json_encode(array("status" => 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
