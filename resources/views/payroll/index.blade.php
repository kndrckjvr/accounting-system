@extends('layouts.app')

@section('content')
<div class="container">
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
                    @if(!$payrolls["items"])
                        {{ 'Empty Payroll' }}
                    @else
                        {{$payrolls}}
                    @endif
                @endslot
            @endcard
        </div>
    </div>
</div>
@endsection