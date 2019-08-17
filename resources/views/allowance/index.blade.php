@extends('layouts.app')

@section('content')
<div class="row justify-content-row">
    <div class="col-12">
        @card
            @slot('title')
                Edit Allowance: {{$payslip->employee->name}}
            @endslot
            @slot('header')
                <div>
                    <a href="{{route('payroll.payslip', ['payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}"
                        class="btn btn-danger"
                        >
                        Return
                    </a>
                    <a href="{{route('allowance.create', ['payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}"
                        class="btn btn-success"
                        >
                        Create
                    </a>
                </div>
                <!-- Papalitan ng uri /allowance/create/{payroll_code}/{employee_id} -->
            @endslot
            @slot('body')
                @if(!count($payslip->allowances))
                    <h6>No Allowance Found</h6>
                @else
                    <div class="table-responsive">
                        <table id="allowance-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Allowance Name</th>
                                    <th style="width: 20%">Amount</th>
                                    <th style="width: 12%">Taxable</th>
                                    <th style="width: 18%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payslip->allowances as $allowance)
                                    <tr>
                                        <td class="align-middle">{{$allowance->name}}</td>
                                        <td class="align-middle">{{$allowance->amount}}</td>
                                        <td class="align-middle">{{$allowance->tax_flag}}</td>
                                        <td class="align-middle">
                                            <form action="{{route('allowance.destroy', ['allowance' => $allowance->id, 'payroll_code' => $payslip->payroll_code, 'employee_id' => $payslip->employee->id])}}" method="post" id="delete-form">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('allowance.edit', ['id' => $allowance->id])}}" role="button" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endslot
        @endcard
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#allowance-table').DataTable();
    });
</script>
@endsection