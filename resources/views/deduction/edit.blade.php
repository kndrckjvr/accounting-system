@extends('layouts.app')

@section('content')
    <div class="row justify-content-row">
        <div class="col-12">
            @card
                @slot('title')
                    Edit: {{$deduction->name}}
                @endslot
                @slot('header')
                    <a href="{{ route('deduction.index', ['payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}" class="btn btn-danger">
                        Cancel
                    </a>
                @endslot
                @slot('body')
                    <form action="{{route('deduction.update', ['deduction' => $deduction->id])}}" method="post">
                        @method('PATCH')
                        @include('deduction.form')
                        @csrf
                        <input type="submit" value="Submit" class="btn btn-primary float-right" />
                    </form>
                @endslot
            @endcard
        </div>
    </div>
@endsection