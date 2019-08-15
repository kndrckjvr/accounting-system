@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
        @slot('title')
        Payslip: {{$payslips->employee->name}}
        @endslot
        @slot('header')
        <a href="{{route('payroll.edit', ['payroll' => $payslips->payroll_code])}}" class="btn btn-danger">
            Return
        </a>
        @endslot
        @slot('body')
        <p>{{$payslips->employee->name}}</p>
        <ul>
            <li>{{$payslips->employee->employee_number}}</li>
            <li>{{$payslips->employee->branch->name}}</li>
        </ul>
        <br />
        <div class="d-flex flex-row align-items-center justify-content-between">
            <h2>Allowance</h2>
            <a href="{{route('allowance.index', ['payroll_code' => $payslips->payroll_code, 'employee_id' => $payslips->employee->id])}}" role="button" class="btn btn-primary">
                Edit Allowance
            </a>
        </div>
        <ul>
            @foreach($payslips->allowances as $allowance)
            <li><strong>{{$allowance->name}}</strong> {{$allowance->amount}}</li>
            @endforeach
        </ul>
        <br />
        <div class="d-flex flex-row align-items-center justify-content-between">
            <h2>Deduction</h2>
            <a href="{{route('deduction.index', ['payroll_code' => $payslips->payroll_code, 'employee_id' => $payslips->employee->id])}}" role="button" class="btn btn-primary">
                Edit Deduction
            </a>
        </div>
        <ul>
            @foreach($payslips->deductions as $deductions)
            <li><strong>{{$deductions->name}}</strong> {{$deductions->amount}}</li>
            @endforeach
        </ul>
        @endslot
        @endcard
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endsection