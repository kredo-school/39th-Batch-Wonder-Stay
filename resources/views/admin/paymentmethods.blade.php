@extends('layouts.admin')

@section('title', 'Admin | Payment Methods')

@section('content')

    <div class="container">
        <h2>Payment Methods</h2>

        {{-- credit card section --}}
        <section class="payment-section">
            <h3><span class="dot"></span>Credit Cards</h3>
            <div class="payment-grid">
                @foreach ($credit_cards as $card)
                    <div class="payment-card">
                        <div class="card-image">
                            <img src="{{ asset('images/payments/' . $card->code . '.png') }}" alt="{{ $card->name }}">
                        </div>

                        @if ($card->is_enabled)
                            <form method="POST" action="{{ route('admin.paymentmethods.disable', $card->code) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-status enabled" onclick="return confirm('Disable this payment method?')">
                                    <i class="fa-solid fa-check"></i> Enabled
                                </button>
                            </form>
                         @else
                            <form method="POST" action="{{ route('admin.paymentmethods.enable', $card->code) }}">
                                @csrf
                                @method('PATCH')                  
                                <button type="submit" class="btn-status add">Add</button>                           
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Digital Wallets --}}
        <section class="payment-section">
            <h3><span class="dot"></span>Digital Wallets</h3>
            <div class="payment-grid">
                @foreach ($digital_wallets as $wallet)
                    <div class="payment-card">
                        <div class="card-image">
                            <img src="{{ asset('images/payments/' . $wallet->code . '.png') }}" alt="{{ $wallet->name }}">
                        </div>

                        @if ($wallet->is_enabled)
                            <form method="POST" action="{{ route('admin.paymentmethods.disable', $wallet->code) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-status enabled" onclick="return confirm('Disable this payment method?')">
                                    <i class="fa-solid fa-check"></i> Enabled
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.paymentmethods.enable', $wallet->code) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-status add">Add</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
