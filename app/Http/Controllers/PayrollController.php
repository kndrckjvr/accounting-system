<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payroll;
use Dotenv\Validator;

class PayrollController extends Controller
{
    // Blocks any access from different users
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Shows the latest five(5) payroll dates
    public function index()
    {
        $payrolls = Payroll::paginate(5);
        return view('payroll.index', compact('payrolls'));
    }

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

    public function attributes()
    {
        return [
            'start_date' => 'Start Date'
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date|unique:payrolls',
            'end_date' => 'required|date|unique:payrolls'
        ]);

        return json_encode(array("status" => 1));
    }
}
