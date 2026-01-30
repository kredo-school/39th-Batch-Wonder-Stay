@extends('layouts.admin')

@section('title', 'Admin | Payment Methods')

@section('content')

<h2>Payment Methods</h2>

{{-- Credit Card --}}
<section class="payment-section">
    <h3> Credit Cards</h3>

    <div class="payment-grid">

        {{-- VISA --}}
        <div class="payment-card">
            <img src="#" alt="VISA">

            @if ($visa->isEnabled())
                {{-- Enabled state --}}
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

        {{-- JCB --}}
        <div class="payment-card">
            <img src="#" alt="JCB">

            @if ($jcb->isEnabled())
                {{-- Enabled state --}}
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

        {{-- AMEX --}}
        <div class="payment-card">
            <img src="#" alt="AMEX">

            @if ($amex->isEnabled())
                {{-- Enabled state --}}
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

        {{-- Mastercard --}}
        <div class="payment-card">
            <img src="#" alt="MasterCard">

            @if ($mastercard->isEnabled())
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

    </div>
</section>

{{-- Digital Wallets --}}
<section class="payment-section">
    <h3>Digital Wallet</h3>

    <div class="payment-grid">
        {{-- Paypal --}}
        <div class="payment-card">
            <img src="#" alt="Paypal">

            @if ($paypal->isEnabled())
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

        {{-- Apple Pay --}}
        <div class="payment-card">
            <img src="#" alt="ApplePay">

            @if ($applePay->isEnabled())
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

        {{-- Google Pay --}}
        <div class="payment-card">
            <img src="#" alt="GooglePay">

            @if ($googlePay->isEnabled())
                <form method="POST" action="#">
                    @csrf
                    {{-- @method ('PATCH') --}}
                    <button type="submit" class="btn-enabled">
                        <i class="fa-solid fa-check"></i>
                        <span>Enabled</span>
                    </button>
                </form>
            @else
                {{-- Add state --}}
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn-add">Add</button>
                </form>
            @endif
        </div>

    </div>
</section>

@endsection