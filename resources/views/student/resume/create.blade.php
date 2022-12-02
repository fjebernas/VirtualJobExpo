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
        <div class="card-body d-flex flex-column">
            <div class="mb-3">
                <form id="store-resume" action={{ route('student.resumes.store') }} method="post" enctype="multipart/form-data">
                @csrf
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
                </form>
            </div>
            
            <div class="align-self-end d-flex" style="column-gap: 7px">
                <button type="submit" form="store-resume" class="btn btn-warning">Upload</button>
                @if (Auth::user()->student->resume)
                    <a href="{{ asset('storage/students/resumes/' . Auth::user()->student->resume->path) }}"
                        target="_blank"
                        class="btn btn-primary">
                        View
                    </a>
                    <form action={{ route('student.resumes.destroy', Auth::user()->student->resume) }} method='POST'>
                        @csrf
                        @method('delete')
                        <button type="submit" 
                                class="btn btn-danger">
                                Remove
                        </button>
                    </form>
                @else
                    <a href="#"
                        target="_blank"
                        class="btn btn-secondary disabled">
                        View
                    </a>
                    <button class="btn btn-secondary disabled">
                        Remove
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
