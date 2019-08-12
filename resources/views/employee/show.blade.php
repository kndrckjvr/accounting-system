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
                <p>{{$employee->basic_pay->amount}}</p>
                <p>{{$employee->branch->name}}</p>
            @endslot
        @endcard
    </div>
</div>
@endsection