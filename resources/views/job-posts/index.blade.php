@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/job-posts/index.css">
@endsection
    
@section('customjs')
    <script src="/js/job-posts/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center page-title">JOB POSTS</h1>
    <div class="d-flex flex-wrap w-100 justify-content-center">
        <div class="card mt-3 search-card" style="min-width: 20rem">
            <div class="card-body d-flex flex-column">
                <h3 class="text-center">SEARCH</h3>
                <form action={{ route('job-posts.search' ) }} method="POST">
                    @csrf
                    <div class="mt-3 mb-3">
                        <label for="keyword_position" class="form-label fs-5 text-muted">Job position</label>
                        <input name="keyword_position" 
                                type="text" 
                                class="form-control" 
                                id="keyword_position"
                                placeholder="e.g. engineer"
                                value=@isset($old_keyword_position) {{ $old_keyword_position }} @endisset>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-start flex-wrap position-relative job-posts-container" style="width: 60rem; max-width: 60rem">
            @forelse ($job_posts as $job_post)
                <div class="card mx-3 mt-3 job-post" style="width: 18rem;">
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
                            @isset($saved_jobs)
                                @if (in_array($job_post->id, $job_applications))
                                    <a href="#" class="btn btn-secondary disabled" style="margin-right: 5px;">Applied</a>
                                @else
                                    <a href={{ route('student.job_applications.create', $job_post->id) }} class="btn btn-warning" style="margin-right: 5px;">Apply now</a>
                                @endif
    
                                <span data-action-delete={{ route('student.saved_jobs.destroy', $job_post->id) }} data-action-create={{ route('student.saved_jobs.store') }}>
                                        <button
                                            name="job_post_id"
                                            value="{{ $job_post->id }}"
                                            class="btn btn-saved-job
                                            @if (in_array($job_post->id, $saved_jobs))
                                                btn-danger delete">
                                                Remove
                                            @else
                                                btn-primary create">
                                                Save
                                            @endif
                                        </button>
                                </span>
                            @else
                                {{-- No buttons to show if user is not student --}}
                            @endisset
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
