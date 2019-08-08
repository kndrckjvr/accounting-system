@extends('layouts.app')

@section('content')
<div class="text-center pt-5" style="height: 100vh;">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like you are not supposed to be here...</p>
    <a href="{{ route('home') }}">&larr; Back to Home</a>
</div>
@endsection