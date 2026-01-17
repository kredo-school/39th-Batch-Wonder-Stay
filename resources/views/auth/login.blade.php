@extends('layouts.app')

@section('content')
<style>
    body{
        background-color: rgba(153, 142, 104, 0.25);
    }
    .login-message{
        color: #AB9D83;
    }
    .card{
        background-color: #AB9D83;
        border-radius: 16px;
        width: 500px;
    }
    .btn {
        background-color: #AB9D83;
        color: white;
        border: 1px solid #9C7A19;
        border-radius: 12px;
    }
    .btn:hover,
    .btn:focus,
    .btn:active {
        background-color: #AB9D83; 
        color: white;              
        border-color: #9C7A19;
        box-shadow: none;
    }
    .form-control {
        background-color: #D9D9D9;
        border: none;
        width: 100%;
    }
    .form-group {
        max-width: 350px;
        margin: 0 auto; /* 全体を中央へ */
    }
    .forgot-link {
        color: #9C7A19;
        text-decoration: underline;
        font-size: 0.9rem;
        opacity: 0.85;
    }

    .forgot-link:hover {
        opacity: 1;
        text-decoration: none;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center h2 py-3 login-message">Please log in to your account</div>
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card py-auto px-3">
                <div class="card-body">
                    <form id="login-form"method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 form-group">
                            <label for="email" class="col-form-label text-md-end text-white">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                        </div>

                        <div class="mb-3 form-group">
                            <label for="password" class="col-form-label text-md-end text-white">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <div class="mb-3 form-group">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center mt-4">
        <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="submit" form="login-form" class="btn px-4 py-2">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                class="forgot-link">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
