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
                        <input name="position" type="text" class="form-control" id="position" placeholder="e.g. Software developer">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="text-muted form-label fw-bold fs-5">Location</label>
                        <input name="location" type="text" class="form-control" id="location" placeholder="e.g. Townsville">
                    </div>

                    <div class="mb-3">
                        <label for="level" class="text-muted form-label fw-bold fs-5">Job level</label>
                        <select name="level" class="form-control">
                            <option value="entry-level">Entry-level</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="senior">Senior</option>
                            <option value="internship">Internship</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="employment" class="text-muted form-label fw-bold fs-5">Employment</label>
                        <select name="employment" class="form-control">
                            <option value="part-time">Part-time</option>
                            <option value="full-time">Full-time</option>
                        </select>
                    </div>

                    <h6 class="pb-2 m-0 fw-bold fs-5">Salary range:</h6>
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

                    <button name="" type="submit" class="btn btn-warning align-self-end">Create job post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
