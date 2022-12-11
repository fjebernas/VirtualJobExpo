@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/students/index.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/students/index.js" type="module"></script>
@endsection

<style>
    tbody td {
        background-color: #000 !important;
    }
</style>

@section('content')
    <h1 class="text-center">ALL STUDENTS</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4 text-nowrap">
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>First name</td>
                    <td>Middle name</td>
                    <td>Last name</td>
                    <td>Birthdate</td>
                    <td>Gender</td>
                    <td>University</td>
                    <td>Contact number</td>
                    <td>about</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->middle_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->birthdate }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->university }}</td>
                        <td>{{ $student->contact_number }}</td>
                        {{-- <td class="text-start text-wrap text-break">{{ $student->about }}</td> --}}
                        <td class="text-center" style="min-width: 300px">
                            <a class="btn btn-link text-warning" 
                                data-bs-toggle="collapse" 
                                href={{ '#about_' . $student->id }} 
                                role="button" 
                                aria-expanded="false" 
                                aria-controls="collapseExample">
                                Show about
                            </a>
                            <p class="collapse text-start text-wrap text-break" 
                                id={{ 'about_' . $student->id }}>
                                {{ $student->about }}
                            </p>
                        </td>
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
