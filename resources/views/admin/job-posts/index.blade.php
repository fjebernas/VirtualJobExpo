@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/job_posts/index.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/job_posts/index.js" type="module"></script>
@endsection

<style>
    tbody td {
        background-color: #000 !important;
    }
</style>

@section('content')
    <h1 class="text-center">ALL JOB POSTS</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4 text-nowrap">
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>Position</td>
                    <td>Company</td>
                    <td>Location</td>
                    <td>Level</td>
                    <td>Employment</td>
                    <td>Salary range</td>
                    <td>Description</td>
                    <td>Deleted at</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_posts as $job_post)
                    <tr @if ($job_post->deleted_at) class='text-muted' @endif>
                        <td>{{ $job_post->id }}</td>
                        <td>{{ $job_post->position }}</td>
                        <td>{{ $job_post->company->name }}</td>
                        <td>{{ $job_post->location }}</td>
                        <td>{{ $job_post->level }}</td>
                        <td>{{ $job_post->employment }}</td>
                        <td>₱{{ $job_post->salary_range['low'] }} to ₱{{ $job_post->salary_range['high'] }}</td>
                        <td class="text-center" style="min-width: 300px">
                            <a class="btn btn-link text-warning" 
                                data-bs-toggle="collapse" 
                                href={{ '#description_' . $job_post->id }} 
                                role="button" 
                                aria-expanded="false" 
                                aria-controls="collapseExample">
                                Show description
                            </a>
                            <p class="collapse text-start text-wrap text-break" 
                                id={{ 'description_' . $job_post->id }}>
                                {{ $job_post->description }}
                            </p>
                        </td>
                        <td>{{ $job_post->deleted_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <i class="text-muted">No data available</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 mx-5 d-md-block d-flex justify-content-center">
        {{ $job_posts->links() }}
    </div>
@endsection
