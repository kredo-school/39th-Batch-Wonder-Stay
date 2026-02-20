@extends('layouts.app')

@section('title', 'Reservation Confirm')

@section('content')
<style>
  .page-title{
    text-align:center;
    color:#9a907d;
    margin:18px 0 10px;
    font-size:22px;
  }
  .card-ws{
    width:520px;
    max-width:92vw;
    margin: 0 auto 16px;
    background:#a89a82;
    border-radius:18px;
    padding:22px 26px;
    color:#fff;
  }
  .card-ws h3{
    font-size:22px;
    margin:0 0 14px;
    color:#FFF7E6;
    letter-spacing:.02em;
  }
  .rowline{
    margin:10px 0;
    line-height:1.4;
  }
  .rowline span{
    color:#FFF7E6;
    font-weight:600;
  }
  .total-box{
    margin-top:14px;
    background:rgba(255,255,255,.22);
    border:1px solid rgba(255,255,255,.25);
    padding:12px 14px;
    border-radius:14px;
  }
  .total{
    font-size:20px;
    font-weight:800;
    letter-spacing:.02em;
  }

  .actions{
    width:520px;
    max-width:92vw;
    margin: 0 auto 30px;
    display:flex;
    gap:18px;
    justify-content:space-between;
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
  .btn-ws.primary{ background:#b28b33; }
</style>
<div class="page-title">Please confirm your reservation information</div>

{{-- 予約内容表示 --}}
<div class="card-ws">
  <h3>Hotel / Room</h3>

  <div class="rowline"><span>Hotel</span> : {{ $hotel->name }}</div>

  <div class="rowline">
    <span>Room</span> :
    Room #{{ $room->room_number }}
    / {{ $room->bed_type }}
    / cap {{ $room->capacity }}
    / ${{ number_format($room->price, 2) }} per night
  </div>

  <div class="rowline">
    <span>Payment</span> : {{ $paymentMethod->name }}
    @if($maskedCard)
        ({{ $maskedCard }})
    @endif
  </div>

  <div class="rowline"><span>Check-in</span> : {{ $validated['check_in_date'] }} @if(!empty($validated['check_in_time'])) ({{ $validated['check_in_time'] }}) @endif</div>
  <div class="rowline"><span>Check-out</span> : {{ $validated['check_out_date'] }}</div>

  <div class="total-box">
    <div class="rowline"><span>Nights</span> : {{ $nights }}</div>
    <div class="rowline total"><span>Total</span> : ${{ number_format($totalPrice, 2) }}</div>
    <div style="opacity:.85; font-size:13px; margin-top:6px;">
      * Room stock is 1, so total = nights × room price
    </div>
  </div>
</div>

<div class="card-ws">
  <h3>Guest</h3>

  <div class="rowline"><span>Name</span> : {{ $validated['guest_first_name'] }} {{ $validated['guest_last_name'] }}</div>
  <div class="rowline"><span>Age</span> : {{ $validated['guest_age'] }}</div>
  <div class="rowline"><span>Email</span> : {{ $validated['guest_email'] }}</div>

  <div class="rowline"><span>Address</span> : {{ $validated['guest_address'] ?? '—' }}</div>
  <div class="rowline"><span>Phone</span> : {{ $validated['guest_phone'] ?? '—' }}</div>
</div>

<div class="card-ws">
  <h3>Accommodation</h3>

  <div class="rowline"><span>Guests</span> : {{ $validated['guests_count'] }}</div>
  <div class="rowline"><span>Special Request</span> : {{ $validated['special_request'] ?? '—' }}</div>
</div>

{{-- 確定フォーム --}}
<form method="POST" action="{{ route('reservations.store', $hotel) }}">
  @csrf

  {{-- confirmで受け取った値を全部 hidden で持ち回す --}}
  @foreach($validated as $k => $v)
    @if(is_array($v))
      @foreach($v as $vv)
        <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
      @endforeach
    @else
      <input type="hidden" name="{{ $k }}" value="{{ $v }}">
    @endif
  @endforeach

  <div class="actions">
    {{-- 戻る：入力画面に戻す（ブラウザバックで入力残ることが多い） --}}
    <a class="btn-ws" href="{{ url()->previous() }}">Back</a>

    {{-- 確定 --}}
    <button class="btn-ws primary" type="submit">Complete reservation</button>
  </div>
</form>
@endsection