@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Branch Create
            @endslot

            @slot('header')
                <a href="#" role="button" class="btn btn-primary" id="click-upload">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span class="pl-1">Upload CSV</span>
                </a>
                <form action="{{ route('branch.upload') }}" method="post" enctype="multipart/form-data" style="display:none" id="csv-form">
                    @csrf
                    <input type="file" name="csv" id="csv">
                </form>
            @endslot
            @slot('body')
                <form action="{{ route('branch.store') }}" method="post">
                    @include('branch.form')
                    @csrf
                    <input type="submit" value="Submit" class="btn btn-primary float-right">
                </form>
            @endslot
        @endcard
    </div>
</div>

<script>
    $('#click-upload').on('click', function(e) {
        e.preventDefault();
        $('#csv').trigger('click');
    });

    $('#csv').on('change', function(e) {
        // $('#csv-form').submit();
    });
    // $('#branch')
    //     .selectpicker()
    //     .filter('.with-ajax')
    //     .ajaxSelectPicker(options);

    // $("'branch').on('change', function(e) {
    //     $('#branch_hidden').val($(e.currentTarget).val());
    // });
</script>
@endsection