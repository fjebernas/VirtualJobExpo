@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/student/job-application/create.css">
@endsection
    
@section('customjs')
    <script src="/js/student/job-application/create.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>MAKE YOUR PITCH!</h1>

        <div class="card bg-light mt-3 w-100" style="max-width: 42rem;">
            <div class="card-header">
                Applying for:
            </div>
            <div class="card-body row">
                <div class="col">
                    <p>
                        <span class="fw-bold">Position: </span> {{ $job_post->position }}
                    </p>
                    <p>
                        <span class="fw-bold">Company: </span> {{ $job_post->company }}
                    </p>
                </div>
                <div class="col">
                    <p>
                        <span class="fw-bold">Location: </span> {{ $job_post->location }}
                    </p>
                    <p>
                        <span class="fw-bold">Salary range: </span> ₱{{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card bg-light mt-3 w-100" style="max-width: 42rem;">
            <div class="card-header">
                Job Application
            </div>
            <form action="/student/job-applications/{{ $job_post->id }}" method="POST">
                @csrf

                <div class="card-body d-flex flex-column">
                    <div class="form-label fw-bold fs-5">
                        <label for="floatingTextarea2">Your pitch:</label>
                        <textarea name="pitch" class="form-control mt-2" placeholder="Hint: Avoid generic pitches like 'I'm responsible'" id="floatingTextarea2" style="height: 150px; resize: none;"></textarea>
                    </div>

                    <button type="submit" class="btn btn-warning align-self-end">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
