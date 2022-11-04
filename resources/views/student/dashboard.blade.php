@extends('layouts.app')

@section('content')
    <h1 class="text-center">STUDENT DASHBOARD</h1>

    <h3 class="text-center">{{ Auth::user()->email }}</h3>
@endsection
