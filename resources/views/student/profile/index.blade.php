@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/profile/view.css">
@endsection
    
@section('customjs')
    <script src="/js/student/profile/view.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1>VIEW PROFILE</h1>

        <div class="card bg-light mt-3 w-100" style="max-width: 42rem">
            <div class="card-header">
                View Profile
            </div>
            <div class="card-body">
                <h5 class="card-title fw-bold">First name</h5>
                <p class="card-text">
                    @isset($student->first_name)
                        {{ $student->first_name }}
                    @endisset
                </p>
            
                <h5 class="card-title fw-bold">Middle name</h5>
                <p class="card-text">
                    @isset($student->middle_name)
                        {{ $student->middle_name }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Last name</h5>
                <p class="card-text">
                    @isset($student->last_name)
                        {{ $student->last_name }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Birthdate</h5>
                <p class="card-text">
                    @isset($student->birthdate)
                        {{ $student->birthdate }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Gender</h5>
                <p class="card-text">
                    @isset($student->gender)
                        {{ $student->gender }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">University</h5>
                <p class="card-text">
                    @isset($student->university)
                        {{ $student->university }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Email</h5>
                <p class="card-text">
                    {{ Auth::user()->email }}
                </p>

                <h5 class="card-title fw-bold">Contact number</h5>
                <p class="card-text">
                    @isset($student->contact_number)
                        {{ $student->contact_number }}
                    @endisset
                </p>
            </div>
        </div>
    </div>
@endsection