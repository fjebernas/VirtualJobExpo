@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/shortlisted-candidates/index.css">
@endsection
    
@section('customjs')
    <script src="/js/company/shortlisted-candidates/index.js" type="module"></script>
@endsection

@section('content')
    <div class="" id="sending-invitation-loader">
        <img src="/img/ball-triangle.svg" alt="" srcset="">
        <h2 class="fs-4 mt-5 text-muted">Sending invitation</h2>
    </div>

    <h1 class="text-center">SHORTLISTED CANDIDATES</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Job Post</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_applications as $job_application)
                    <tr>
                        <td>{{ $job_application->student->last_name }}</td>
                        <td>{{ $job_application->student->user->email }}</td>
                        <td>{{ $job_application->jobPost->position }}</td>
                        <td>
                            <form action={{ route('company.shortlisted-candidates.send-invitation') }} method="POST">
                                @csrf
                                <input type="hidden" name="job_application_id" value='{{ $job_application->id }}'>
                                <button type='button' 
                                        class="btn-send-invitation btn btn-warning">
                                        Send invitation
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <i class="text-muted">No shortlisted candidates</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
