@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center animate__animated animate__backInLeft animate__delay-1s">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.login') }}</div>

                <div class="card-body">
                    <div id="capslockdiv" style="display: none;"
                        class="alert alert-warning animate__animated animate__tada" role="alert">
                        <b>{{ __('welcome.warning') }}!</b> {{ __('welcome.caps_on') }}
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="user_login"
                                class="col-md-4 col-form-label text-md-right">{{ __('auth.username') }}<i
                                    class="ml-2 fas fa-user"></i></label>

                            <div class="col-md-6">
                                <input id="user_login" type="text"
                                    class="form-control @error('user_login') is-invalid @enderror" name="user_login"
                                    value="{{ old('user_login') }}" required autocomplete="user_login" autofocus>

                                @error('user_login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }}<i
                                    class="ml-2 fas fa-key"></i></label>

                            <div class="col-md-6">
                                <div class="d-flex">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    <button id="sh_password" type="button" class="btn btn-outline-primary ml-2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt mr-2"></i> {{ __('auth.btnLogin') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
