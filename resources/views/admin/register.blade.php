@extends('layouts.app')
@section('content')

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Register</div>
                                <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                    <div class="card au-card chart-percent-card">
                                                <div class="#"><B>USER</B></div>
                                                <HR></HR>
                                            <div class="card-body">
                                                <table class="table table-data2">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-group-divider">
                                                    @foreach ($users as $user)
                                                        <tr class="tr-shadow">
                                                            <td>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>
                                                                <span class="block-email">{{ $user->email }}</span>
                                                            </td>
                                                            <td>2018-09-27 02:12</td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                        <div class="col-md-4">
                            <div class="card au-card chart-percent-card">
                                    <div class="#"><B>ADD USER</B></div>
                                    <HR></HR>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>
                                            <div class="col-md-9">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email') }}</label>
                                            <div class="col-md-9">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Permit Number') }}</label>
                                            <div class="col-md-9">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm" class="col-md-3 col-form-label text-md-end">{{ __('Confirm Permit Number') }}</label>
                                            <div class="col-md-9">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="permit" class="col-md-3 col-form-label text-md-end">{{ __('Permit Document') }}</label>
                                            <div class="col-md-9">
                                                <input id="permit" type="file" class="form-control @error('permit') is-invalid @enderror" name="permit">
                                                @error('permit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-3" style="display: flex; justify-content: center;">
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
            </div>
        </div>
    </div>
</div>
@endsection