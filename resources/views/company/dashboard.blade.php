@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/company/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/company/dashboard.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>COMPANY DASHBOARD</h1>

        <a href="/company/profile">View Profile</a>
        <a href="/company/profile/edit">Edit Profile</a>
        <a href="/company/job-post">See all my job posts</a>
        <a href="/company/job-post/create">Create a job post</a>
    </div>
@endsection
