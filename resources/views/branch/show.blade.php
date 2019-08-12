@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Branch: {{$branch->name}}
            @endslot
            @slot('header')
                <a href="{{route('branch.index')}}" role="button" class="btn btn-danger">
                    Return
                </a>
            @endslot
            @slot('body')
                <p>{{$branch->name}}</p>
                <ul>
                    @foreach($branch->employees as $employee)
                        <li>{{$employee->name}}</li>
                    @endforeach
                </ul>
            @endslot
        @endcard
    </div>
</div>
@endsection