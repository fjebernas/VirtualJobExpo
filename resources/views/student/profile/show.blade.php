@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/profile/show.css">
@endsection
    
@section('customjs')
    <script src="/js/student/profile/show.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1>VIEW PROFILE</h1>

        <div class="card mt-3 w-100">
            <div class="card-header d-flex justify-content-between">
            </div>
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-center flex-wrap" style="column-gap: 20px; row-gap: 10px">
                    <span>
                        <img src=@if ($student->user->profilePicture)
                                    {{ asset('storage/students/images/' . $student->user->profilePicture->path) }}
                                @else
                                    {{ asset('storage/students/images/placeholder.png') }}
                                @endif
                            class="img-thumbnail mb-2 align-self-center" 
                            alt="profile picture"
                            id="profile-picture">
                    </span>
                    <span style="width:400px">
                        <h2 class="hello-plus-name">Hello! I'm @isset($student->first_name) 
                                                                    {{ $student->first_name }}.
                                                                @endisset
                        </h2>
                        <p>{{ $student->about }}</p>
                    </span>
                </div>
                
                <div class="row my-3">
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">First name</h5>
                        <p class="card-text fs-5">
                            @isset($student->first_name)
                                {{ $student->first_name }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Middle name</h5>
                        <p class="card-text fs-5">
                            @isset($student->middle_name)
                                {{ $student->middle_name }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Last name</h5>
                        <p class="card-text fs-5">
                            @isset($student->last_name)
                                {{ $student->last_name }}
                            @endisset
                        </p>
                    </span>
                </div>
                
                <div class="row my-3">
                    <span class="col-8">
                        <h5 class="text-muted card-title fs-6 fw-bold">University</h5>
                        <p class="card-text fs-5">
                            @isset($student->university)
                                {{ $student->university }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Email</h5>
                        <p class="card-text fs-5">
                            {{ $student->user->email }}
                        </p>
                    </span>
                </div>
                <div class="row my-3">
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Contact number</h5>
                        <p class="card-text fs-5">
                            @isset($student->contact_number)
                                {{ $student->contact_number }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Birthdate</h5>
                        <p class="card-text fs-5">
                            @isset($student->birthdate)
                                {{ $student->birthdate }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Gender</h5>
                        <p class="card-text fs-5">
                            @isset($student->gender)
                                {{ $student->gender }}
                            @endisset
                        </p>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection