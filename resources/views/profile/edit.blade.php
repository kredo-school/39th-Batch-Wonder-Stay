@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<style>
    .edit-wrapper{
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding-top:60px;
        min-height:100vh;
        background: #f6f3ed;
    }
    .edit-card{
        background: linear-gradient(145deg, #b8a98a, #a89676);
        padding: 50px;
        border-radius: 25px;
        width: 700px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }
    .icon-upload{
        text-align:center;
        margin-bottom:30px;
    }
    .edit-avatar{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit:cover;
        cursor: pointer;
        border: 4px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transition:0.3s;
    }
    .edit-avatar:hover{
        transform:scale(1.05);
    }
    #icon-input{
        display:none;
    }
    .form-grid{
        display: grid;
        gap: 20px;
        grid-template-columns: 1fr 1fr;
        margin-top: 20px;
    }
    .input{
        padding:12px;
        border-radius: 25px;
        border: none;
        background:#eee;
        text-align: center;
    }
    .btn-back{
        display: inline-block;
        background: #8d7b5e;
        padding: 12px 50px;
        border-radius: 30px;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-back:hover{
        background: #6f5f47;
    }
    .btn-submit{
        margin-top: 30px;
        background: linear-gradient(145deg, #c9a24d, #b88d2a);
        padding: 12px 40px;
        border-radius: 30px;
        color: white;
        border: none;
    }
</style>
<div class="edit-wrapper">
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="edit-card">
        @csrf

        <div class="icon-upload">
                <label for="icon-input">
                    <img src="{{ $user->icon ? asset($user->icon) : asset('images/icons/default-avatar.png') }}" class="edit-avatar">
                </label>
                <input type="file" name="icon" id="icon-input">
        </div>
        
        <div class="form-grid">
            <input type="text" class="input" name="name" value="{{ old('name', $user->name) }}" placeholder="New Name">
            <input type="email" class="input" name="email" value="{{ old('email', $user->email) }}" placeholder="New Email">
            <input type="password" class="input" name="password" placeholder="New Password">
        </div>

        <a href="{{ route('profile.show') }}" class="btn-back">{{ __('Back') }}</a>

        <button class="btn-submit">Update Profile</button>
    </form>
</div>
@endsection
