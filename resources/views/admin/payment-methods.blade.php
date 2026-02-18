@extends('layouts.admin')

@section('title', 'Admin | Payment Methods')

@section('content')

<h2>Payment Methods</h2>
<div class="payment-grid">
    @foreach($paymentMethods as $method)
        <div class="payment-card">
            <div class="card-header">
                <span class="method-name">
                    {{ $method->name }}
                </span>

                <span class="method-type">
                    {{ ucfirst(str_replace('_', ' ', $method->type)) }}
                </span>
            </div>

            <form method="POST" action="{{ route('admin.paymentmethods.toggle', $method) }}">
                @csrf
                @method('PATCH')

                @if ($method->is_enabled)
                    <button type="submit" class="btn-enabled">
                        Enabled
                    </button>
                @else
                    <button type="submit" class="btn-add">
                        Enable
                    </button>
                @endif
            </form>
        </div>
    @endforeach
</div>
@endsection