@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/welcome.css">
@endsection
    
@section('customjs')
    <script src="/js/welcome.js" type="module"></script>
@endsection

@section('content')
    <img id="background-image" src="/img/background.jpg" alt="" srcset="">
    <div class="row banner">
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <h1 class="fs-1 text-white">Get your dream job. 
                <div class="fw-bolder">
                    Now.
                </div>
                @guest
                    <a class="btn btn-primary py-2 px-4 mt-3 fs-5 btn-register" href="/register">Register now</a>
                @else
                    <a class="btn btn-primary py-2 px-4 mt-3 fs-5 btn-register" href="/{{ Auth::user()->role }}/dashboard">Go to Dashboard</a>
                @endguest
            </h1>
        </div>
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <img src="/img/buildings.png" alt="" srcset="">
        </div>
    </div>
    <div class="top-employers d-flex flex-column">
        <h1 class="text-center mb-5 fs-3" style="z-index: 999">
            OUR TOP EMPLOYERS
        </h1>
        <div class="companies-container d-flex justify-content-center align-items-center flex-wrap">
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
            <div class="company d-flex flex-column justify-content-center align-items-center">
                <img src="/img/google.png" width="70" alt="" srcset="">
                <h5 class="pt-2">Google</h5>
            </div>
        </div>
    </div>
@endsection
