@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Edit Payroll
            @endslot
            @slot('header')
                <a href="{{route('payroll.post', ['payroll' => $payroll_code])}}" class="btn btn-success">
                    Post
                </a>
            @endslot
            @slot('body')
                <div class="table-responsive">
                    <table id="table_id" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 12%">Employee ID</th>
                                <th>Employee Name</th>
                                <th>Branch Name</th>
                                <th style="width: 18%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payrolls as $payslip)
                                <tr>
                                    <td class="align-middle">{{$payslip->employee->employee_number}}</td>
                                    <td class="align-middle">{{$payslip->employee->name}}</td>
                                    <td class="align-middle">{{$payslip->employee->branch->name}}</td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <a href="{{route('payroll.payslip', ['payroll'=> $payslip->payroll_code,'payslip' => $payslip->employee->id])}}" role="button" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a href="{{route('payroll.payslip', ['payroll'=> $payslip->payroll_code,'payslip' => $payslip->employee->id])}}" role="button" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endslot
        @endcard
    </div>
</div>
@endsection