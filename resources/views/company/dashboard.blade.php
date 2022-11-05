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

        <a href="/company/view">View Profile</a>
        <a href="/company/edit">Edit Profile</a>
    </div>
@endsection
