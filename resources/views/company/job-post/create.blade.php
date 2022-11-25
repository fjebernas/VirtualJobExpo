@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/job-post/create.css">
@endsection
    
@section('customjs')
    <script src="/js/company/job-post/create.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>CREATE A JOB POST</h1>

        <div class="card mt-3 w-100">
            <form action={{ route('company.job_posts.store') }} method="POST">
                @csrf

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <label for="position" class="text-muted form-label fw-bold fs-5">Position</label>
                        <input name="position" 
                                type="text" 
                                class="form-control @error('position') is-invalid @enderror" 
                                id="position" 
                                placeholder="e.g. Software developer"
                                value={{ old('position') }}>
                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="text-muted form-label fw-bold fs-5">Location</label>
                        <input name="location" 
                                type="text" 
                                class="form-control @error('location') is-invalid @enderror" 
                                id="location" 
                                placeholder="e.g. Townsville"
                                value={{ old('location') }}>
                        @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="level" class="text-muted form-label fw-bold fs-5">Job level</label>
                        <select name="level" 
                                class="form-control @error('level') is-invalid @enderror">
                            <option selected disabled>Select one</option>
                            @foreach ($job_level_types as $job_level)
                                <option value={{ $job_level }}>{{ $job_level }}</option>
                            @endforeach
                        </select>
                        @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="employment" class="text-muted form-label fw-bold fs-5">Employment</label>
                        <select name="employment" 
                                class="form-control @error('employment') is-invalid @enderror">
                            <option selected disabled>Select one</option>
                            @foreach ($employment_types as $employment)
                                <option value={{ $employment }}>{{ $employment }}</option>
                            @endforeach
                        </select>
                        @error('employment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h6 class="pb-2 m-0 text-muted fw-bold fs-5">Salary range:</h6>
                    <fieldset class="row gx-2">
                        <div class="col input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">min</span>
                            <input name="salary_range[]" type="number" min="0" class="form-control text-center" placeholder="ex: 15000" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">max</span>
                            <input name="salary_range[]" type="number" min="0" class="form-control text-center" placeholder="ex: 25000" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </fieldset>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label fw-bold fs-5 text-muted">description</label>
                        <textarea name="description" 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                rows="5" 
                                placeholder="e.g. Create/maintain applications and improve them."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button name="" type="submit" class="btn btn-warning align-self-end">Create job post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
