@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/shortlisted-candidates/index.css">
@endsection
    
@section('customjs')
    <script src="/js/company/shortlisted-candidates/index.js" type="module"></script>
@endsection

@section('content')
    <div class="" id="sending-invitation-loader">
        <img src="{{ Vite::asset('resources/images/ball-triangle.svg') }}" alt="" srcset="">
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
                    <th scope="col" style="width: 15%">Send Invitation</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_applications as $job_application)
                    <tr>
                        <td>
                            <a href={{ route('student.students.show', $job_application->student) }}
                                class="link text-warning">
                                {{ $job_application->student->first_name }} {{ $job_application->student->last_name }}
                            </a>
                        </td>
                        <td>{{ $job_application->student->user->email }}</td>
                        <td>
                            <a href={{ route('job-posts.show', $job_application->jobPost) }}
                                class="link text-white">
                                {{ $job_application->jobPost->position }}
                            </a>
                        </td>
                        <td>
                            <form action={{ route('company.shortlisted-candidates.send-invitation') }} method="POST">
                                @csrf
                                <input type="hidden" name="job_application_id" value='{{ $job_application->id }}'>
                                <button type='button' 
                                        @if ($job_application->invited)
                                            class="btn-send-invitation btn">
                                            <box-icon name='mail-send' color='grey'></box-icon>
                                        @else
                                            class="btn-send-invitation btn">
                                            <box-icon name='mail-send' color='#5630bd'></box-icon>
                                        @endif
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
