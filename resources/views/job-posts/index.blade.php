@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/job-posts/index.css">
@endsection
    
@section('customjs')
    <script src="/js/job-posts/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center page-title">
        @isset($old_keywords)
            Search results: found {{ $job_posts->total() }}
        @else
            JOB POSTS
        @endisset
    </h1>
    <div class="d-flex flex-wrap w-100 justify-content-center">
        <div class="card mt-3 search-card d-none d-xxl-block" style="min-width: 20rem">
            <div class="card-body d-flex flex-column">
                <h3 class="text-center">SEARCH</h3>
                <form action={{ route('job-posts.search' ) }} method="POST">
                    @csrf
                    <div class="mt-1 mb-2">
                        <label for="keyword_position" class="form-label fs-5 text-muted">Job position</label>
                        <input name="keyword_position" 
                                type="text" 
                                class="form-control" 
                                id="keyword_position"
                                placeholder="e.g. engineer"
                                value=@isset($old_keywords['position']) {{ $old_keywords['position'] }} @endisset>
                    </div>
                    <div class="mb-2">
                        <label for="keyword_company" class="form-label fs-5 text-muted">Company name</label>
                        <input name="keyword_company" 
                                type="text" 
                                class="form-control" 
                                id="keyword_company"
                                placeholder="e.g. ABC Inc."
                                value=@isset($old_keywords['company']) {{ $old_keywords['company']}} @endisset>
                    </div>
                    <div class="mb-2">
                        <label for="level" class="text-muted form-label fs-5">Job level</label>
                        <select name="level" class="form-control">
                            <option value="">All</option>
                            @foreach ($job_level_types as $job_level)
                                @isset($old_keywords['job_level'])
                                    @if ($old_keywords['job_level'] == $job_level)
                                        <option selected value={{ $job_level }}>{{ $job_level }}</option>
                                    @else
                                        <option value={{ $job_level }}>{{ $job_level }}</option>
                                    @endif
                                @else
                                    <option value={{ $job_level }}>{{ $job_level }}</option>
                                @endisset
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="employment" class="text-muted form-label fs-5">Employment</label>
                        <select name="employment" class="form-control">
                            <option value="">All</option>
                            @foreach ($employment_types as $employment)
                                @isset($old_keywords['employment'])
                                    @if ($old_keywords['employment'] == $employment)
                                        <option selected value={{ $employment }}>{{ $employment }}</option>
                                    @else
                                        <option value={{ $employment }}>{{ $employment }}</option>
                                    @endif
                                @else
                                    <option value={{ $employment }}>{{ $employment }}</option>
                                @endisset
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="salary-range" class="text-muted form-label fs-5 mb-0">Minimum salary offer</label>
                        <input type="range" 
                                value=@isset($old_keywords['salary_range'])
                                        {{ $old_keywords['salary_range'] }}
                                    @else
                                        15000
                                    @endisset
                                name="salary_range"
                                class="form-range" 
                                min="15000" 
                                max="90000" 
                                step="5000" 
                                id="salary-range" 
                                style="width: 17rem">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">₱15,000+</span>
                            <span class="text-white" id="range-value"></span>
                            <span class="text-muted">₱90,000+</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-center flex-wrap position-relative job-posts-container" style="width: 60rem; max-width: 60rem">
            @forelse ($job_posts as $job_post)
                <div class="card mx-3 mt-3 job-post" style="width: 18rem; height: fit-content">
                    <div class="card-header border-0 d-flex mt-2 mb-0 pb-0" style="column-gap: 10px">
                        <img src={{ asset('img/profile-picture/company/' . $job_post->company->profile_picture_path) }} 
                            class="img-thumbnail" 
                            alt="profile picture"
                            id="profile-picture">
                        <div>
                            <a href={{ route('job-posts.show', $job_post) }} class="link text-warning">
                                <h5 class="card-title" style="width: 12rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">
                                    {{ $job_post->position }}
                                </h5>
                            </a>
                            <a href={{ route('company.companies.show', $job_post->company) }} class="link text-white mb-2">
                                <h6 class="card-subtitle">
                                    {{ $job_post->company->name }}
                                </h6>
                            </a>
                        </div>
                    </div>
                    <div class="card-body mt-3 pt-0">
                        <h6 class="card-subtitle mb-2 text-muted">{{ $job_post->location }}</h6>
                        <ul>
                            <li class="text-muted">{{ $job_post->level }}</li>
                            <li class="text-muted">{{ $job_post->employment }}</li>
                            <li class="text-muted">
                                ₱{{ number_format($job_post->salary_range['low']) }} 
                                to ₱{{ number_format($job_post->salary_range['high']) }}
                            </li>
                        </ul>
                        <div class="d-flex flex-wrap buttons-container">
                            @if (Auth::check())
                                @if (Auth::user()->role == 'student')
                                    @if ($job_post->jobApplications->contains('student_id', Auth::user()->student->id))
                                        <a href="#" class="btn btn-secondary disabled" style="margin-right: 5px;">Applied</a>
                                    @else
                                        <a href={{ route('student.job_applications.create', $job_post->id) }} class="btn btn-warning" style="margin-right: 5px;">Apply now</a>
                                    @endif
                                    <span data-action-delete={{ route('student.saved_jobs.destroy', $job_post->id) }} data-action-create={{ route('student.saved_jobs.store') }}>
                                        <button
                                            name="job_post_id"
                                            value="{{ $job_post->id }}"
                                            class="btn btn-saved-job
                                            @if ($job_post->savedJobs->contains('student_id', Auth::user()->student->id))
                                                btn-primary create">
                                                Save
                                            @else
                                                btn-danger delete">
                                                Remove
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
            @empty
                <h2 class="fs-4 text-center text-muted fst-italic mt-5"
                    style="position: absolute;
                            margin-left: auto;
                            margin-right: auto;
                            left: 0;
                            right: 0;
                            text-align: center;">
                    No available jobs as of now
                </h2>
            @endforelse
        </div>
    </div>
    
    <div class="mt-4 mx-5 d-md-block d-flex justify-content-center">
        {{ $job_posts->links() }}
    </div>
@endsection
