@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Branch List
            @endslot

            @slot('header')
            @endslot

            @slot('body')
                @if(!count($branches))
                    <h6>No Branches found!</h6>
                @else
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 12%">Branch ID</th>
                                    <th>Branch Name</th>
                                    <th style="width: 18%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($branches as $branch)
                                <tr>
                                    <td class="align-middle">{{$branch->id}}</td>
                                    <td class="align-middle">
                                        <a href="{{route('branch.show', ['branch'=>$branch->id])}}">{{$branch->name}}</a>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <a href="{{route('branch.edit', ['id' => $branch->id])}}" role="button" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a href="{{route('branch.edit', ['id' => $branch->id])}}" role="button" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endslot
        @endcard
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

@endsection