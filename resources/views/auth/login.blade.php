@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-md-6 loginImage d-none d-md-block" style="background-color: #00679A;">
            <div class="d-flex justify-content-center mt-5">
               <img src="{{ asset('/images/login1.png') }}" width="75%" class="mt-5" alt="Login Image" style="object-fit:cover;margin-top: 50px;" bottom="0%">
            </div>
        </div>
        <div class="" style="position:absolute;top:5%;left:15%"><h2 class="text-info" style="">Gestion des taches</h2></div>

        <div class="col-md-6" style="background-color:white">
            <div class="container align-items-center">
                <div class="mb-4 text-info"  style="text-align:center; font-weight:bold; margin-top:100px;"> <h3> Gestion des Taches</h3></div>
                <div class="mb-3 text-dark"  style="text-align:center; font-weight:bold;"> <h4> Se Connecter</h4></div>
                <div class="mt-4 col-md-8 offset-md-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            </div>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                            </div>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{-- {{ __('Login') }} --}} Connexion
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
<style>
    /* .loginImage{
        background-image: url("./images/login.jpg")
    } */
</style>
