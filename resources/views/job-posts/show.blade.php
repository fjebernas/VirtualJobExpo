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
                        <img src={{ asset('storage/companies/images/' . $job_post->company->profile_picture_path) }} 
                            class="img-thumbnail mb-2 align-self-center" 
                            alt="profile picture"
                            id="profile-picture">
                    </span>
                    <span class="" style="width:400px">
                        <h2 class="text-warning">{{ $job_post->position }}</h2>
                        <h4>{{ $job_post->company->name }}</h4>
                        <h5 class="text-muted">{{ $job_post->location }}</p>
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
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Level</h5>
                        <p class="card-text fs-5">
                            @isset($job_post->level)
                                {{ $job_post->level }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Salary range</h5>
                        <p class="card-text fs-5">
                            ₱{{ number_format($job_post->salary_range['low']) }} 
                            to {{ number_format($job_post->salary_range['high']) }}
                        </p>
                    </span>
                </div>

                <div class="row my-3">
                    <span class="col">
                        <h5 class="text-muted card-title fs-6 fw-bold">Job description</h5>
                        <p class="card-text fs-5">
                            {{ $job_post->description }}
                        </p>
                    </span>
                </div>

                <div class="d-flex flex-wrap buttons-container">
                    @if (Auth::check())
                        @if (Auth::user()->role == 'student')
                            @if ($job_post->jobApplications->contains('student_id', Auth::user()->student->id))
                                <a href="#" 
                                    class="btn btn-secondary disabled" 
                                    style="margin-right: 5px;">
                                    Applied
                                </a>
                            @else
                                <a href={{ route('student.job_applications.create', $job_post->id) }} 
                                    class="btn btn-warning" 
                                    style="margin-right: 5px;">
                                    Apply now
                                </a>
                            @endif
                            <span data-action-delete={{ route('student.saved_jobs.destroy', $job_post->id) }} 
                                    data-action-create={{ route('student.saved_jobs.store') }}>
                                <button
                                    name="job_post_id"
                                    value="{{ $job_post->id }}"
                                    class="btn btn-saved-job
                                    @if ($job_post->savedJobs->contains('student_id', Auth::user()->student->id))
                                        btn-danger delete">
                                        Remove
                                    @else
                                        btn-primary create">
                                        Save
                                    @endif
                                </button>
                            </span>
                        @endif
                    @else
                        {{-- No buttons to show if user is not student --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
