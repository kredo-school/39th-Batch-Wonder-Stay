@extends('layouts.app')

@section('title', 'Reservation Notification')

@section('content')
<div style="display:flex;justify-content:center;margin-top:60px;">
    <div style="
        width:900px;
        background:#b5a98c;
        padding:60px;
        border-radius:12px;
        border:2px solid #333;
        text-align:center;
        color:white;
        box-shadow:0 4px 10px rgba(0,0,0,0.2);
    ">
        <h1 style="font-size:48px;margin-bottom:40px;">
            Thank you for your reservation.
        </h1>

        <p style="font-size:24px;margin-bottom:30px;">
            Your booking has been successfully completed.
        </p>

        <p style="font-size:24px;margin-bottom:30px;">
            We have sent the details to your email.
        </p>

        <p style="font-size:24px;margin-bottom:50px;">
            You can check 
            <a href="#" style="color:#3aa0e6;text-decoration:underline;">
                here</a>.
        </p>

        <p style="font-size:28px;">
            We look forward to welcoming you on the day of your stay.
        </p>
    </div>
</div>

<div style="text-align:center;margin-top:40px;">
    <a href="{{ route('main') }}" style="
        background:#8f7f63;
        color:white;
        padding:15px 40px;
        border-radius:12px;
        border:2px solid white;
        text-decoration:none;
        font-size:22px;
        box-shadow:0 4px 8px rgba(0,0,0,0.3);
    ">
        Back to Home Page
    </a>
</div>
@endsection
