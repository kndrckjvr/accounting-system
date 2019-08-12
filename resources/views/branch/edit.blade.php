@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            @card
                @slot('title')
                    Editing: {{$branch->name}}
                @endslot
                @slot('header')
                    <a href="{{route('branch.index')}}" role="button" class="btn btn-danger">Cancel</a>
                @endslot
                @slot('body')
                    <form action="{{route('branch.update', $branch->id)}}" method="post">
                        @method('PATCH')
                        @include('branch.form')
                        @csrf
                        <input type="submit" value="Submit" class="btn btn-primary float-right">
                    </form>
                @endslot
            @endcard
        </div>
    </div>
@endsection