@extends('layouts.app')

@section('title', 'Reservation')

@section('content')
<style>
.page-title{
    text-align:center;
    color:#9a907d;
    margin:20px 0 10px;
    font-size:22px;
}

.card-ws{
    width:520px;
    max-width:92vw;
    margin:0 auto 26px;
    background:#a89a82;
    border-radius:18px;
    padding:22px 26px;
    color:#fff;
}

.card-ws h3{
    font-size:22px;
    margin-bottom:14px;
    color:#FFF7E6;
}

.field{ margin:12px 0; }

.label{
    display:block;
    margin-bottom:6px;
    color:#FFF7E6;
}

.input, .select{
    width:100%;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid rgba(0,0,0,.25);
    background:rgba(255,255,255,.35);
    color:#2b2b2b;
}

.actions{
    width:520px;
    max-width:92vw;
    margin:0 auto 30px;
    display:flex;
    gap:18px;
}

.btn-ws{
    flex:1;
    text-align:center;
    padding:14px 10px;
    border-radius:14px;
    background:#8f7f62;
    color:#fff;
    text-decoration:none;
    font-size:18px;
    border:2px solid rgba(255,255,255,.2);
    cursor:pointer;
}

.btn-ws.primary{
    background:#b28b33;
}

.error{
    margin-top:6px;
    color:#3b0000;
    background:rgba(255,255,255,.35);
    padding:6px 10px;
    border-radius:8px;
    font-size:13px;
}
</style>
@if($errors->any())
    <div style="background: red;color:white;padding:10px;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="page-title">
    Please input any information for reservation
</div>



<form method="POST" action="{{ route('reservations.confirm', $hotel) }}">
@csrf

    {{-- ================= Guest Info ================= --}}

    <div class="card-ws">
        <h3>About Guest</h3>

        <div class="field">
            <label class="label">First Name</label>
            <input class="input" name="guest_first_name" value="{{ old('guest_first_name') }}">
            @error('guest_first_name')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label class="label">Last Name</label>
            <input class="input" name="guest_last_name" value="{{ old('guest_last_name') }}">
            @error('guest_last_name')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label class="label">Age (18+ only)</label>
            <input class="input" type="number" name="guest_age" value="{{ old('guest_age') }}">
            @error('guest_age')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label class="label">Email</label>
            <input class="input" type="email" name="guest_email" value="{{ old('guest_email') }}">
            @error('guest_email')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label class="label">Address</label>
            <input class="input" name="guest_address" value="{{ old('guest_address') }}">
        </div>

        <div class="field">
            <label class="label">Phone Number</label>
            <input class="input" name="guest_phone" value="{{ old('guest_phone') }}">
        </div>

        <div class="field">
            <label class="label">Payment Method</label>

            @foreach($paymentMethods as $method)
                <label style="display:block; margin-bottom:6px;">
                    <input type="radio"
                        name="payment_method_id"
                        value="{{ $method->id }}"
                        data-code="{{ $method->code }}"
                        {{ old('payment_method_id') == $method->id ? 'checked' : '' }}>
                    {{ $method->name }}
                </label>
            @endforeach

            @error('payment_method_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div id="card-fields" style="display: none;">
            <div>
                <input class="input" type="text" name="card_number" value="{{ old('card_number') }}" placeholder="Card Number">
                <input class="input" type="text" name="card_cvc" value="{{ old('card_cvc') }}" placeholder="CVC">
                <input class="input" type="text" name="card_name" value="{{ old('card_name') }}" placeholder="Card Holder Name">
                <input class="input" type="text" name="card_expiry" value="{{ old('card_expiry') }}" placeholder="MM/YY">
            </div>
        </div>

    </div>

    {{-- ================= Accommodation ================= --}}

    <div class="card-ws">
        <h3>About Accommodation</h3>


        <div class="field">
            <label class="label">Number of Guests</label>
            <input class="input" type="number" name="guests_count" value="{{ old('guests_count') }}">
        </div>

        <div class="field">
            <label class="label">Room Type</label>
            <select class="select" name="hotel_detail_id">
                <option value="">Select Room</option>
                @foreach($roomTypes as $r)
                    <option value="{{ $r->id }}" @selected(old('hotel_detail_id')==$r->id)>
                        {{ $r->room_type }} / {{ $r->bed_type }} / cap {{ $r->capacity }} / ${{ $r->price }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label class="label">Check-in Date</label>
            <input class="input" type="date" name="check_in_date" value="{{ old('check_in_date') }}">
        </div>

        <div class="field">
            <label class="label">Check-out Date</label>
            <input class="input" type="date" name="check_out_date" value="{{ old('check_out_date') }}">
        </div>

        <div class="field">
            <label class="label">Check-in Time</label>
            <input class="input" type="time" name="check_in_time" value="{{ old('check_in_time') }}">
        </div>

        <div class="field">
            <label class="label">Special Request</label>
            <input class="input" name="special_request" value="{{ old('special_request') }}">
        </div>


    </div>

    <div class="actions">
        <a class="btn-ws" href="{{ url()->previous() }}">Back</a>
        <button type="submit" class="btn-ws primary">
            Confirm your reservation
        </button>
    </div>

</form>

<script>
    document.querySelectorAll('input[name="payment_method_id"]').forEach(radio => {
        radio.addEventListener('change', function() {

            const cardCodes = ['visa', 'amex', 'mastercard'];
            const checked = document.querySelector('input[name="payment_method_id"]:checked');
            
            if(cardCodes.includes(this.dataset.code)){
                document.getElementById('card-fields').style.display = 'block';
            } else {
                document.getElementById('card-fields').style.display = 'none';
            }

            if(checked) {
                const cardCodes = ['visa', 'amex', 'mastercard'];

                if(cardCodes.includes(checked.dataset.code)){
                    document.getElementById('card-fields').style.display = 'block';
                }
            } 
        });
    });
</script>
@endsection
