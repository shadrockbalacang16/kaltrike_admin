@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('Welcome to Home Page') }}</h1>
                        <p class="text-lead text-light">
                            {{ __('This is your application home page.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h3>Dashboard Overview</h3>
                            <p>Welcome to your application dashboard. You can customize this page with your content.</p>
                            
                            @auth
                                <div class="mt-4">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mr-3">Admin Dashboard</a>
                                    <a href="{{ route('profile.edit') }}" class="btn btn-info">Edit Profile</a>
                                </div>
                            @else
                                <div class="mt-4">
                                    <a href="/login" class="btn btn-primary mr-3">Login</a>
                                    <a href="/register" class="btn btn-success">Register</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection