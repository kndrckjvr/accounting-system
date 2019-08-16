@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            @card
                @slot('title')
                    Create Deduction
                @endslot
                @slot('header')
                    <a href="{{route('deduction.index', ['payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}" class="btn btn-danger" role="button">
                        Cancel
                    </a>
                @endslot
                @slot('body')
                    <form action="{{route('deduction.store')}}" method="post">
                        @csrf
                        {{$deduction->types}}
                        @include('deduction.form')
                        <input type="submit" value="Submit" class="btn btn-primary float-right">
                    </form>
                @endslot
            @endcard
        </div>
    </div>
    <script>
        $("#type").on('change', function (e) {
            switch($(e.currentTarget).val()) {
                case "1":
                    $('#name').val("Witholding Tax");
                    $('#amount').val(0);
                break;
                case "2":
                    $('#name').val("SSS Contribution");
                    $('#amount').val(0);
                break;
                case "3":
                    $('#name').val("PhilHealth Contribution");
                    $('#amount').val(0);
                break;
                case "4":
                    $('#name').val("PAGIBIG Contribution");
                    $('#amount').val(0);
                break;
            }
        });
    </script>
@endsection