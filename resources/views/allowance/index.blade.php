@extends('layouts.app')

@section('content')
    <div class="row justify-content-row">
        <div class="col-12">
            @card
                @slot('title')
                    Edit Allowance: {{$payslip->employee->name}}
                @endslot
                @slot('header')
                    <a href="{{route('allowance.create')}}">Create</a>
                    <!-- Papalitan ng uri /allowance/create/{payroll_code}/{employee_id} -->
                @endslot
                @slot('body')
                    @if(!count($payslip->allowances))
                        <h6>No Allowance Found</h6>
                    @else
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered">
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
                                            <td>{{$allowance->name}}</td>
                                            <td>{{$allowance->amount}}</td>
                                            <td>{{$allowance->tax_flag}}</td>
                                            <td>
                                                <a href="{{route('allowance.edit', ['id' => $allowance->id])}}" role="button" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a href="{{route('allowance.destroy', ['id' => $allowance->id])}}" role="button" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </a>
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
@endsection