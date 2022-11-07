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

        <a href="/student/profile">View Profile</a>
        <a href="/student/profile/edit">Edit Profile</a>
        <a href="/student/saved-jobs">Saved Jobs</a>
    </div>
@endsection
