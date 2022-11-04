@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/student/dashboard.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>STUDENT DASHBOARD</h1>

        <a href="/student/view">View Profile</a>
        <a href="/student/edit">Edit Profile</a>
    </div>
@endsection
