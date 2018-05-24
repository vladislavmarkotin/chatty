@extends('templates.default')
@section('content')

@stop


@if (Route::has('login'))
@if (Auth::check())

@endif
@endif
