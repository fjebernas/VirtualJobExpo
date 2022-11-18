@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/job-posts/show.css">
@endsection
    
@section('customjs')
    <script src="/js/job-posts/show.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1>JOB POST</h1>

        <div class="card mt-3 w-100">
            <div class="card-header d-flex justify-content-between">
            </div>
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-start flex-wrap" style="column-gap: 20px; row-gap: 10px">
                    <span class="">
                        <img src={{ asset('img/profile-picture/company/' . $job_post->company->profile_picture_path) }} 
                            class="img-thumbnail mb-2 align-self-center" 
                            alt="profile picture"
                            id="profile-picture">
                    </span>
                    <span class="" style="width:400px">
                        <h2 class="hello-plus-name">@isset($job_post->position) 
                                                        {{ $job_post->position }}
                                                    @endisset
                        </h2>
                        <p>{{ $job_post->description }}</p>
                    </span>
                </div>
                
                <div class="row my-3">
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Company</h5>
                        <p class="card-text fs-5">
                            @isset($job_post->company->name)
                                {{ $job_post->company->name }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Location</h5>
                        <p class="card-text fs-5">
                            @isset($job_post->location)
                                {{ $job_post->location }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Level</h5>
                        <p class="card-text fs-5">
                            @isset($job_post->level)
                                {{ $job_post->level }}
                            @endisset
                        </p>
                    </span>
                </div>
                
                <div class="row my-3">
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Employment</h5>
                        <p class="card-text fs-5">
                            @isset($job_post->employment)
                                {{ $job_post->employment }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-8">
                        <h5 class="text-muted card-title fs-6 fw-bold">Salary range</h5>
                        <p class="card-text fs-5">
                            ₱{{ $job_post->salary_range['low'] }} to {{ $job_post->salary_range['high'] }}
                        </p>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
