@extends('layouts.app')

<style>
    .card {
        background-color: rgba(0, 0, 0, 0.7) !important;
        color: #fff;
    }

    input[type='text'],
    input[type='date'],
    input[type='number'],
    input[type='file'],
    select,
    input[type='email'],
    input[type='password'] {
        background-color: rgb(26, 26, 26) !important;
        color: rgba(255, 255, 255, 0.7) !important;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" 
                                        type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        autocomplete="email"
                                        placeholder="e.g. user@example.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-end">Role</label>
                            <div class="col-md-6 d-flex flex-column justify-content-center">
                                <div class="d-flex align-items-center @error('role') is-invalid @enderror" style="column-gap: 15px">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="role" 
                                                value="student" 
                                                id="student">
                                        <label class="form-check-label text-muted" for="student">
                                            Student
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="role" 
                                                value="company" 
                                                id="company">
                                        <label class="form-check-label text-muted" for="company">
                                            Company
                                        </label>
                                    </div>
                                </div>
                                @error('role')
                                    <span class="invalid-feedback align-self-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
