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

        <div class="card mt-3 w-100" style="max-width: 42rem;">
            <div class="card-header text-muted">
                Applying for:
            </div>
            <div class="card-body row">
                <div class="col">
                    <p>
                        <span class="fw-bold text-muted">Position: </span> {{ $job_post->position }}
                    </p>
                    <p>
                        <span class="fw-bold text-muted">Company: </span> {{ $job_post->company->name }}
                    </p>
                </div>
                <div class="col">
                    <p>
                        <span class="fw-bold text-muted">Location: </span> {{ $job_post->location }}
                    </p>
                    <p>
                        <span class="fw-bold text-muted">Salary range: </span> ₱{{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card mt-3 w-100">
            <div class="card-header text-muted">
                Job Application
            </div>
            <form action={{ route('student.job_applications.store' ) }} method="POST" id="form-submit">
                @csrf

                <div class="card-body d-flex flex-column">
                    <div class="form-label fw-bold fs-5">
                        {{-- job post id --}}
                        <input type="hidden" name="job_post_id" value="{{ $job_post->id }}">
                        <label for="floatingTextarea2"><span class="text-muted">Your pitch:</span></label>
                        <textarea name="pitch" 
                                class="form-control mt-2 @error('pitch') is-invalid @enderror" 
                                placeholder="Hint: Avoid generic pitches like 'I'm responsible'" 
                                id="floatingTextarea2" 
                                style="height: 150px; resize: none;"
                        ></textarea>
                        @error('pitch')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning align-self-end">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
