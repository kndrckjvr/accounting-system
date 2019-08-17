@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @card
            @slot('title')
                Branch List
            @endslot

            @slot('header')
                <a href="{{route('branch.create')}}" role="button" class="btn btn-primary">
                    Create
                </a>
            @endslot

            @slot('body')
                @if(!count($branches))
                    <h6>No Branches found!</h6>
                @else
                    <div class="table-responsive">
                        <table id="branch-table" class="table table-bordered">
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
                                        <form action="{{route('branch.destroy', ['branch' => $branch->id])}}" method="post" id="delete-form">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{route('branch.edit', ['id' => $branch->id])}}" role="button" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>
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
        $('#branch-table').DataTable();
    });
</script>

@endsection