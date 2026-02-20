@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<style>
    body{
        background: #f6f3ed;
        font-family: 'Cormorant Garamond', serif;
        letter-spacing: 0.05px;
    }
    .profile-wrapper {
        background: #f2efe8;
        padding: 50px;
        min-height: 50vh;
    }
    .profile-card {
        background: linear-gradient(145deg, #b8a98a, #a89676);
        padding: 50px;
        border-radius: 25px;
        max-width: 600px;
        margin: 60px auto;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }
    .profile-box{
        background: rgba(255, 255, 255, 0.9);
        padding: 12px 20px;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 30px;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .profile-avatar{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border: 5px solid rgba(255, 255, 255, 0.6);
        background: linear-gradient(145deg, #d6c7a3, #a8926f);
        display:block;
        object-fit: cover;
    }
    .profile-buttons{
        display: flex;
        justify-content: space-between;
        max-width: 900px;
        margin: 30px auto 0;
    }
    .btn-back{
        background: #8d7b5e;
        padding: 12px 60px;
        border-radius: 40px;
        color: white;
        font-size: 18px;
        transition: 0.3s;
    }
    .btn-back:hover{
        background: #6f5f47;
    }
    .btn-edit{
        background: linear-gradient(145deg, #c9a24d, #b88d2a);
        padding: 12px 60px;
        border-radius: 40px;
        color: white;
        font-size: 18px;
        transition: 0.3s;
    }
    .btn-edit:hover{
        background: linear-gradient(145deg, #b88d2a, #a67b1f);
    }
    .success-message{
        max-width: 600px;
        margin: 20px auto;
        padding: 12px;
        text-align: center;
        background: #d4c4a8;
        color: #fff;
        border-radius: 10px;
    }
    .reservation-history{
        background: white;
        padding: 25px;
        border-radius: 20px;
        margin:40px auto;
        max-width: 900px;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .btn-cancel{
        background: #a94442;
        color:white;
        border:none;
        padding: 8px 18px;
        border-radius: 20px;
    }
    .reservation-history{
        margin-top:40px;
    }
    .reservation-history h3{
        margin-bottom: 20px;
    }
    .reservation-card{
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .reservation-card.cancelled{
        opacity: 0.5;
    }
    .btn-cancel{
        background: #8c2f2f;
        color:#fff;
        padding:8px 16px;
        border-radius:20px;
        border:none;
        cursor: pointer;
    }
        
</style>
@if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif
<div class="profile-wrapper">
    <div class="profile-card">
        <div class="profile-header" style="display: flex; align-items: center; gap: 40px;">
            <img class="profile-avatar" src="{{ $user->icon ? asset($user->icon) : asset('images/icons/default-avatar.png') }}" alt="avatar">

            <div class="profile-info">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <div class="profile-box">{{ $user->name }}</div>
                </div>

                <div class="form-group">
                    <label>{{ __('Email') }}</label>
                    <div class="profile-box">{{ $user->email }}</div>
                </div>

                <div class="form-group">
                    <label>{{ __('Points and Grades') }}</label>
                    <div class="profile-box">
                        {{ $points }} pt / {{ $grade }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="reservation-history">
        <h3>{{ __('History of reservations') }}</h3>

        @forelse($reservations as $reservation)
            <div class="reservation-card {{ $reservation->status }}">
                <div>
                    <strong>{{ $reservation->hotel->name }}</strong><br>
                    <small class="text-muted">
                        Room: {{ $reservation->hotelDetail->room_number }}
                    </small><br>
                    <small>
                        {{ $reservation->check_in_date }} ~ {{ $reservation->check_out_date }}<br>
                    </small>
                </div>
                <div>
                    {{ __('Status') }}: {{ ucfirst($reservation->status) }}
                </div>

                @if($reservation->status !== 'cancelled')
                    <form method="POST" action="{{ route('reservations.cancel', $reservation) }}"
                     onsubmit="return confirm('Are you sure to cancel this reservation?');">
                        @csrf
                        @method('PATCH')
                        <button class="btn-cancel">{{ __('Cancel Reservation') }}</button>
                    </form>
                @endif
            </div>
        @empty
            <p>{{ __('No reservations yet.') }}</p>
        @endforelse
    </div>
</div>

<div class="profile-buttons">
    <a href="{{ route('main') }}" class="btn-back">{{ __('Back') }}</a>
    <a href="{{ route('profile.edit') }}" class="btn-edit">{{ __('Edit Profile') }}</a>
</div>
@endsection

