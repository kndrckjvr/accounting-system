@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            @card
                @slot('title')
                    Editing: {{$employee->name}}
                @endslot
                @slot('header')
                    <a href="{{route('employee.index')}}" role="button" class="btn btn-danger">Cancel</a>
                @endslot
                @slot('body')
                    <form action="{{route('employee.update')}}" method="post"></form>
                @endslot
            @endcard
        </div>
    </div>
@endsection