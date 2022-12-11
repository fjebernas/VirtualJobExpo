@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/index.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/index.js" type="module"></script>
@endsection

<style>
    tbody td {
        background-color: #000 !important;
    }
</style>

@section('content')
    <h1 class="text-center">ALL USERS</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4">
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Created at</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <i class="text-muted">No data available</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
