@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @card
                    @slot('title')
                        Employee List
                    @endslot
            
                    @slot('header')
                    @endslot
            
                    @slot('body')
                    <h6>Employee List is empty!</h6>
                    @endslot
                @endcard
            </div>
        </div>
    </div>
@endsection