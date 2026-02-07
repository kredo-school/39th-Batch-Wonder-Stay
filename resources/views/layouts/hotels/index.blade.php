@extends('layouts.app')

@section('title', 'Hotel Listings')

@section('content')
<style>
  .hotel-page{
    min-height: calc(100vh - 56px);
    padding: 40px 0 60px;
  }

  .hotel-title{
    font-family: serif;
    letter-spacing: .5px;
    font-size: 50px;
    color:#9b9487;
    margin-bottom: 26px; 
  }

  .layout{
    display: grid;
    grid-template-columns: 1.05fr 1.25fr;
    gap: 34px;
    align-items: start;
  }

  .left-main{
    border-radius: 18px;
    overflow:hidden;
    border: 3px solid rgba(255, 255, 255, 0.749);
    box-shadow: 0 12px 26px rgba(0,0,0,.18);
    background:#eee;
  }
  .left-main img{
    width:100%;
    height: 360px;
    object-fit: cover;
    display:block;
  }

  .thumb-row{
    display:flex;
    gap: 16px;
    justify-content:flex-end;
    margin-bottom: 18px;
  }
  .thumb{
    width: 170px;
    height: 120px;
    border-radius: 18px;
    overflow:hidden;
    border: 3px solid rgba(255, 255, 255, 0.748);
    background:#eee;
    box-shadow: 0 10px 18px rgba(0,0,0,.10);
  }
  .thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }
  .info-box{
    background: rgba(150, 140, 120, .55);
    border-radius: 18px;
    padding: 26px 30px;
    border: 3px solid rgba(255, 255, 255, 0.749);
    color: rgba(255,255,255,.92);
    font-family: serif;
    line-height: 1.9;
    box-shadow: 0 10px 18px rgba(0,0,0,.10);
  }
  .info-box .rowline{
    margin: 12px 0;
    text-align:left;
    font-size: 22px;
  }
    .info-box .rowline span{
        font-weight: bold;
        text-decoration: underline;
        color: rgb(152, 117, 14);
    }

  .btn-row{
    display:flex;
    justify-content: space-between;
    gap: 24px;
    margin-top: 36px;
    padding: 0 40px;
  }
  .big-btn{
    width: 420px;
    padding: 18px 20px;
    border-radius: 16px;
    font-size: 25px;
    font-family: serif;
    border: 2px solid rgba(255,255,255,.7);
    box-shadow: 0 6px 18px rgba(0,0,0,.12);
    text-decoration:none;
    text-align:center;
    display:inline-block;
  }
  .btn-back{ background:#8b7f6c; color:#fff; }
  .btn-reserve{ background:#b8943f; color:#fff; }

  @media (max-width: 992px){
    .layout{ grid-template-columns: 1fr; }
    .thumb-row{ justify-content:flex-start; flex-wrap: wrap; }
    .big-btn{ width: 100%; }
    .btn-row{ padding: 0; }
  }
</style>
@php
  // main以外の写真を4枚取得（is_main=false優先、足りなければphotosから）
  $extra = collect($hotel->photos ?? [])
      ->filter(fn($p) => !$p->is_main)
      ->sortBy('sort_order')
      ->values()
      ->take(4);

  // feature/service は array or string どっちでもOK
  $features = is_array($hotel->feature) ? $hotel->feature : (empty($hotel->feature) ? [] : [$hotel->feature]);
  $services = is_array($hotel->service) ? $hotel->service : (empty($hotel->service) ? [] : [$hotel->service]);
@endphp

<div class="hotel-page">
  <div class="container">

    <div class="hotel-title">{{ $hotel->name }}</div>

    <div class="layout">

      {{-- 左：mainPhoto（クリックでphotos/showへ） --}}
      <a href="{{ route('hotels.show', $hotel->id) }}?start=0" class="left-main d-block">
        @if($hotel->mainPhoto)
          <img src="{{ asset($hotel->mainPhoto->path) }}" alt="{{ $hotel->name }}">
        @else
          <div class="p-5 text-center text-muted">{{ __('No Image') }}</div>
        @endif
      </a>

      {{-- 右：上4枚 + 下情報ボックス --}}
      <div>
        <div class="thumb-row">
          @foreach($extra as $p)
            <a href="{{ route('hotels.show', $hotel->id) }}?start={{ 1 + $loop->index }}"
                class="thumb">
                <img src="{{ asset($p->path) }}" alt="{{ $hotel->name }}">
            </a>
          @endforeach

          {{-- 4枚に満たない場合の空枠（見た目維持したいなら） --}}
          @for($i = $extra->count(); $i < 4; $i++)
            <div class="thumb" style="opacity:.35;"></div>
          @endfor
        </div>

        <div class="info-box">
          @if(!empty($hotel->concept))
            <div class="rowline"><span>{{ __('Concept') }}</span> : {{ $hotel->concept }}</div>
          @endif

          @if(!empty($features))
            <div class="rowline">
              <span>{{ __('Feature') }}</span> :
              {{ is_array($hotel->feature) ? implode(' / ', array_filter($features)) : $hotel->feature }}
            </div>
          @endif

          @if(!empty($services))
            <div class="rowline">
              <span>{{ __('Service') }}</span> :
              {{ is_array($hotel->service) ? implode(' / ', array_filter($services)) : $hotel->service }}
            </div>
          @endif
        </div>
        </div>
    </div>

    {{-- 下のボタン --}}
    <div class="btn-row">
      <a href="{{ route('main') }}" class="big-btn btn-back">{{ __('Back') }}</a>

      {{-- 予約ルートがまだなら href="#" のままでもOK --}}
      <a href="#"
         class="big-btn btn-reserve">
        {{ __('Reserve this hotel\'s room') }}
      </a>
    </div>

  </div>
</div>
@endsection