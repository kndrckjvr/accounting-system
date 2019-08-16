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