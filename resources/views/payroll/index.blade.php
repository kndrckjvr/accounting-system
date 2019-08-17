@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Payrolls
            @endslot
            @slot('header')
                <a href="{{ route('payroll.create') }}" role="button" class="btn btn-primary">Create</a>
            @endslot
            @slot('body')
            @if(!count($payrolls))
                <h6>No Payrolls found!</h6>
            @else
                <div class="table-responsive">
                    <table id="payroll-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 12%">Payroll Code</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th style="width: 18%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payrolls as $payroll)
                            <tr>
                                <td class="align-middle">{{$payroll->payroll_code}}</td>
                                <td class="align-middle">{{$payroll->start_date}}</td>
                                <td class="align-middle">{{$payroll->end_date}}</td>
                                <td class="align-middle">
                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <a href="{{route('payroll.edit', ['payroll' => $payroll->payroll_code])}}" role="button" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a href="{{route('payroll.edit', ['payroll' => $payroll->payroll_code])}}" role="button" class="btn btn-danger">
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
            @endif
        @endslot
        @endcard
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#payroll-table').DataTable();
    });
</script>
@endsection