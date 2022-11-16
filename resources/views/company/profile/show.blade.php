@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/company/profile/show.css">
@endsection
    
@section('customjs')
    <script src="/js/company/profile/show.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1>VIEW PROFILE</h1>

        <div class="card mt-3 w-100" style="max-width: 42rem">
            <div class="card-header d-flex justify-content-between">
                {{-- <span>
                    <a href={{ route('student.students.edit', $company) }}>
                        Edit Profile
                    </a>
                </span> --}}
            </div>
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-center flex-wrap" style="column-gap: 20px; row-gap: 10px">
                    <span class="">
                        <img src={{ asset('img/profile-picture/company/' . $company->profile_picture_path) }} 
                            class="img-thumbnail mb-2 align-self-center" 
                            alt="profile picture"
                            id="profile-picture">
                    </span>
                    <span class="" style="width:400px">
                        <h2 class="hello-plus-name">@isset($company->name) 
                                {{ $company->name }}
                            @endisset
                        </h2>
                        <p>{{ $company->about }}</p>
                    </span>
                </div>
                
                <div class="row my-3">
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Industry</h5>
                        <p class="card-text fs-5">
                            @isset($company->industry)
                                {{ $company->industry }}
                            @endisset
                        </p>
                    </span>
                    <span class="col-8">
                        <h5 class="text-muted card-title fs-6 fw-bold">Address</h5>
                        <p class="card-text fs-5">
                            @isset($company->address)
                                {{ $company->address }}
                            @endisset
                        </p>
                    </span>
                </div>
                
                <div class="row my-3">
                    <span class="col-4">
                        <h5 class="text-muted card-title fs-6 fw-bold">Email</h5>
                        <p class="card-text fs-5">
                            {{ $company->user->email }}
                        </p>
                    </span>
                    <span class="col-8">
                        <h5 class="text-muted card-title fs-6 fw-bold">Contact number</h5>
                        <p class="card-text fs-5">
                            @isset($company->contact_number)
                                {{ $company->contact_number }}
                            @endisset
                        </p>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection