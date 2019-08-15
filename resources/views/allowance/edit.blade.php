@extends('layouts.app')

@section('content')
    <div class="row justify-content-row">
        <div class="col-12">
            @card
                @slot('title')
                    Edit: {{$allowance->name}}
                @endslot
                @slot('header')
                    <a href="{{ route('allowance.index', ['payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}" class="btn btn-danger">
                        Cancel
                    </a>
                @endslot
                @slot('body')
                    <form action="{{route('allowance.update', ['allowance' => $allowance->id])}}" method="post">
                        @method('PATCH')
                        @include('allowance.form')
                        @csrf
                        <input type="submit" value="Submit" class="btn btn-primary float-right" />
                    </form>
                @endslot
            @endcard
        </div>
    </div>
@endsection