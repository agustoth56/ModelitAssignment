@extends('layouts.app')

@section('content')
<div class="container">
    @if(Route::current()->uri()=="favorites")
        <favorite/>
        @else
        <general/>
    @endif
</div>
@endsection
