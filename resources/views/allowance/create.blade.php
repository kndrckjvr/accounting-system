@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            @card
                @slot('title')
                    Create Allowance
                @endslot
                @slot('header')
                    <a href="{{route('allowance.index', ['payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}" class="btn btn-danger" role="button">
                        Cancel
                    </a>
                @endslot
                @slot('body')
                    <form action="{{route('allowance.store')}}" method="post">
                        @csrf
                        @include('allowance.form')
                        <input type="submit" value="Submit" class="btn btn-primary float-right">
                    </form>
                @endslot
            @endcard
        </div>
    </div>
@endsection