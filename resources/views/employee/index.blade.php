@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Employee List
            @endslot

            @slot('header')
                <a href="{{route('employee.create')}}" role="button" class="btn btn-primary">
                    Create
                </a>
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
                                    <th style="width: 18%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td class="align-middle">{{$employee->employee_number}}</td>
                                    <td class="align-middle">
                                        <a href="{{route('employee.show', ['employee'=>$employee->id])}}">{{$employee->name}}</a>
                                    </td>
                                    <td class="align-middle">{{$employee->branch->name}}</td>
                                    <td class="align-middle">
                                        <form action="{{route('employee.destroy', ['employee' => $employee->id])}}" method="post" id="delete-form">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{route('employee.edit', ['id' => $employee->id])}}" role="button" class="btn btn-warning">
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
        $('#table_id').DataTable();
    });
</script>

@endsection