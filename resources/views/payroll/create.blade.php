@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Create Payroll</h6>
                    <a href="{{ route('home') }}" role="button" class="btn btn-danger">Cancel</a>
                </div>

                <div class="card-body">
                    <form action="#" id="payroll_form" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="start_date">Start Date</label>
                                <input 
                                    type="text" 
                                    name="start_date" 
                                    id="start_date" 
                                    class="datepicker form-control{{ ($errors->has('start_date')) ? ' is-invalid' : '' }}" 
                                    value="{{ old('start_date') ?? $suggestStartDate }}" />
                                @if($errors->has('start_date'))
                                <span class="invalid-feedback">
                                    {{$errors->first('start_date')}}
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-6">
                                <label for="end_date">End Date</label>
                                <input 
                                    type="text" 
                                    name="end_date" 
                                    id="end_date" 
                                    class="datepicker form-control{{ ($errors->has('end_date')) ? ' is-invalid' : '' }}" 
                                    value="{{ old('end_date') ?? $suggestEndDate }}" />
                                @if($errors->has('end_date'))
                                <span class="invalid-feedback">
                                    {{$errors->first('end_date')}}
                                </span>
                                @endif
                            </div>
                        </div>
                        <input type="submit" value="Proceed" class="btn btn-primary float-right"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.datepicker').datepicker({
            autoclose: true
        });

        $("#payroll_form").on('submit', function(e) {
            e.preventDefault();
            axios.post(
                '{{ route('payroll.store') }}', 
                {
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val()
                }
            ).then((res) => {
                console.log(res.data);
            })
        });
    });
</script>
@endsection