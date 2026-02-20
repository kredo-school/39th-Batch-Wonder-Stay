@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container py-4">

    {{-- 検索条件表示 --}}
    <div class="mb-4 p-3 bg-light rounded shadow-sm">
        <strong>{{ $hotels->count() }}{{ __(' found') }}</strong>
        <div class="text-muted small">
            📍 {{ $destination }} <br>
            {{ $checkin }} → {{ $checkout }} / {{ $people }} {{ __('people') }}
        </div>
    </div>

    @forelse($hotels as $hotel)
        <div class="card mb-4 border-0 shadow-sm">

            <div class="row g-0">

                {{-- 画像 --}}
                <div class="col-md-4">
                    @if($hotel->mainPhoto)
                        <img src="{{ asset($hotel->mainPhoto->path) }}"
                             class="img-fluid rounded-start"
                             style="height:100%; object-fit:cover;">
                    @else
                        <div class="p-5 text-center text-muted">{{ __('No Image') }}</div>
                    @endif
                </div>

                {{-- 情報 --}}
                <div class="col-md-8">
                    <div class="card-body d-flex flex-column justify-content-between h-100">

                        <div>
                            <h4 class="fw-bold mb-1">{{ $hotel->name }}</h4>

                            {{-- 都市 --}}
                            <p class="text-muted mb-2">
                                📍 {{ $hotel->city->name ?? 'Unknown location' }}
                            </p>
                            {{-- コンセプト --}}
                            @if(!empty($hotel->concept))
                                <p class="mb-2">
                                    {{ $hotel->concept }}
                                </p>
                            @endif

                            {{-- 特徴 --}}
                            @if(!empty($hotel->feature))
                                <p class="mb-2">
                                    <strong>{{ __('Feature') }}:</strong>
                                    {{ is_array($hotel->feature) ? implode(' / ', array_filter($features))
                                        : $hotel->feature }}
                                </p>
                            @endif

                            {{-- サービス --}}
                            @if(!empty($hotel->service))
                                <p class="mb-2">
                                    <strong>{{ __('Service') }}:</strong>
                                    {{ is_array($hotel->service) ? implode(' / ', array_filter($services))
                                        : $hotel->service }}
                                </p>
                            @endif
                        </div>

                        {{-- 下部 --}}
                        <div class="d-flex justify-content-between align-items-end mt-3">

                            {{-- 価格（仮） --}}
                            <div>
                                <small class="text-muted">Per one night</small><br>
                                <strong class="fs-5">
                                    ${{ number_format($hotel->hotelDetails->min('price') ?? 0) }}
                                </strong>
                            </div>

                            {{-- ボタン --}}
                            <a href="{{ route('reservations.create', $hotel) }}"
                               class="btn btn-dark px-4">
                                Reserve
                            </a>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    @empty
        {{-- 0件 --}}
        <div class="text-center py-5">
            <h4>{{ __('There are no hotels.') }}</h4>
            <p class="text-muted">{{ __('Please change the date or number of people and search again.') }}</p>
        </div>
    @endforelse
    <div class="text-center mt-5">
        <a href="{{ url()->previous() }}" class="btn btn-outline-dark px-5 py-2">
            Back
        </a>
    </div>
</div>
@endsection