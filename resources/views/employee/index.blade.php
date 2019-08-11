@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Employee List
            @endslot

            @slot('header')
            @endslot

            @slot('body')
                @if(!count($employees))
                    <h6>No Employees found!</h6>
                @else
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 12%">Employee ID</th>
                                    <th>Employee Name</th>
                                    <th style="width: 20%">Branch Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->employee_number}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->branch->name}}</td>
                                    <td>
                                        <a href="{{route('employee.edit', ['id' => $employee->id])}}" role="button" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
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

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

@endsection