@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>VIEW PROFILE</h1>

        <div class="card bg-light mt-3" style="min-width: 42rem;">
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
                    @isset($student->email)
                        {{ $student->email }}
                    @endisset
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