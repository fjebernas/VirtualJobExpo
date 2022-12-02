@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/student/job-application/index.css">
@endsection
    
@section('customjs')
    <script src="/js/student/job-application/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">JOB APPLICATION STATUS</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center text-nowrap table-bordered mt-4">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">Position</th>
                    <th scope="col">Company</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_applications as $job_application)
                    <tr class="job-application">
                        <td>
                            <a href={{ route('job-posts.show', $job_application->jobPost) }}
                                class="link text-warning fw-bold">
                                {{ $job_application->jobPost->position }}
                            </a>
                        </td>
                        <td>
                            <a href={{ route('company.companies.show', $job_application->jobPost->company) }}
                                class="link text-white">
                                {{ $job_application->jobPost->company->name }}
                            </a>
                        </td>
                        <td class="fst-italic fw-bold">
                            @switch($job_application->status)
                                @case('Received')
                                    <span class="text-info">
                                    @break
                                @case('Shortlisted')
                                    <span class="text-success">
                                    @break
                                @case('Not qualified')
                                    <span class="text-danger">
                                    @break
                                @default
                                    <span class="text-warning">Unknown status
                            @endswitch
                                        {{ $job_application->status }}
                                    </span>
                        </td>
                        <td>
                            <span data-action-delete={{ route('student.job_applications.destroy', $job_application->id) }}>
                                <button class="btn p-0 btn-delete-job-application">
                                    <box-icon type='solid' name='trash' color='#dc3545'></box-icon>
                                </button>
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <i class="text-muted">No jobs applied</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
