@extends('layouts.app')

@section('content')
    @include('layouts.headers.guest')
    
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">Register Driver</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive" style="overflow-x: auto;-webkit-overflow-scrolling: touch;">
                            <table class="table table-data2" style="font-size: 1rem;padding: 1rem;">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Permit Number</th>
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
                                  <td>
                                    <span class="block-email">{{ $user->permitnumber }}</span>
                                  </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card au-card chart-percent-card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">Register Driver</h3>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" style="max-width: 700px; margin-top:5px" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"> {{ session('success') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pages/register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('First Name') }}</label>
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
                                    <label for="middlename" class="col-md-3 col-form-label text-md-end">{{ __('Middle Name') }}</label>
                                    <div class="col-md-9">
                                        <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" required autocomplete="middlename" autofocus>
                                        @error('middlename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="lastname" class="col-md-3 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                    <div class="col-md-9">
                                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                        @error('lastname')
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
                    @include('layouts.footers.auth')
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush