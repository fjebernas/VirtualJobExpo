@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/student/resume/create.css">
@endsection
    
@section('customjs')
    <script src="/js/student/resume/create.js" type="module"></script>
@endsection

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center w-100">
    <h1>MY RESUME</h1>

    <div class="card w-100 mt-3">
        <form action={{ route('student.resumes.store') }} method="post" enctype="multipart/form-data">
            @csrf

            <div class="card-body d-flex flex-column">
                <div class="mb-3">
                    <label class="form-label fw-bold fs-5 text-muted" for="resume">
                        Resume status: 
                        @if (Auth::user()->student->resume)
                            <span class="text-success">Uploaded</span>
                        @else
                            <span class="text-danger">Not yet uploaded</span>
                        @endif
                    </label>
                    <input name="resume" 
                            type="file" 
                            class="form-control @error('resume') is-invalid @enderror" 
                            id="resume" />
                    @error('resume')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="align-self-end d-flex" style="column-gap: 7px">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
