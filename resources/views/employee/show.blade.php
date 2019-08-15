@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Employee: {{$employee->name}}
            @endslot
            @slot('header')
                <a href="{{route('employee.index')}}" role="button" class="btn btn-danger">
                    Return
                </a>
            @endslot
            @slot('body')
                <p>{{$employee->name}}</p>
                <p>{{$employee->current_basic_pay->amount}}</p>
                <p>{{$employee->branch->name}}</p><br/>
                <p>Basic Pay History</p>
                <ul>
                    @foreach($employee->basic_pay as $basic_pay)
                        <li><strong>{{$basic_pay->amount}}</strong> {{date('F j, Y', strtotime($basic_pay->created_at))}}</li>
                    @endforeach
                </ul>
            @endslot
        @endcard
    </div>
</div>
@endsection