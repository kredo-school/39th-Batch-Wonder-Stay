@extends('layouts.app')

@section('content')
<style>
    body{
        background-color: rgba(153, 142, 104, 0.25);
    }
    .register-message{
        color: #AB9D83;
    }
    .card{
        background-color: #AB9D83;
        border-radius: 16px;
        width: 635px;
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
        border: 2px solid #9C7A19;
        box-shadow: none;
    }
    .form-control {
    background-color: #D9D9D9;
    border: none;
    width: 100%;
    }
    .form-group {
        max-width: 420px;
        margin: 0 auto; /* 全体を中央へ */
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center h2 py-3 register-message">Please register your account</div>
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card py-auto px-3">
                <div class="card-body">
                    <form id="register-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 form-group">
                            <label for="name" class="form-label text-md-end text-white">{{ __('Name') }}</label>
                            <input id="name" 
                                   type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>

                        <div class="mb-3 form-group">
                            <label for="email" class="form-label text-md-end text-white">{{ __('Email Address') }}</label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        
                        </div>

                        <div class="mb-3 form-group">
                            <label for="password" class="form-label text-md-end text-white">{{ __('Password') }}</label>
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>

                        <div class="mb-3 form-group">
                            <label for="password-confirm" class="form-label text-md-end text-white">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" 
                                   type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <button type="submit" form="register-form" class="btn py-2 px-4">
            {{ __('Register') }}
        </button>
    </div>
</div>
@endsection
