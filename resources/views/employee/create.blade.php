@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Employee Create
            @endslot

            @slot('header')
                <a href="#" role="button" class="btn btn-primary" id="click-upload">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span class="pl-1">Upload CSV</span>
                </a>
                <form action="{{ route('employee.upload') }}" method="post" enctype="multipart/form-data" style="display:none" id="csv-form">
                    @csrf
                    <input type="file" name="csv" id="csv">
                </form>
            @endslot
            @slot('body')
                <form action="{{ route('employee.store') }}" method="post">
                    @include('employee.form')
                    @csrf
                    <input type="submit" value="Submit" class="btn btn-primary float-right">
                </form>
            @endslot
        @endcard
    </div>
</div>

<script>
    var options = {
        values: "a, b, c",
        ajax: {
            url: "http://127.0.0.1:8000/branch/try",
            type: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}',
                search_text: "@{{{q}}}"
            }
        },
        locale: {
            emptyTitle: "Select and Begin Typing"
        },
        log: 3,
        preprocessData: function(data) {
            var i,
                l = data.branch.length,
                array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push(
                        $.extend(true, data.branch[i], {
                            text: data.branch[i].name,
                            value: data.branch[i].id
                        })
                    );
                }
            }
            // You must always return a valid array when processing data. The
            // data argument passed is a clone and cannot be modified directly.
            return array;
        }
    };

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