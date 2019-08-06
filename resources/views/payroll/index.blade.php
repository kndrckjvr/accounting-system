@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Payrolls</h6>
                    <a href="{{ route('payroll.create') }}" role="button" class="btn btn-primary">Create</a>
                </div>

                <div class="card-body">
                    @if(!$payrolls["items"])
                        {{ 'Empty Payroll' }}
                    @else
                        {{$payrolls}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection