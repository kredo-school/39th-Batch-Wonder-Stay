@extends('layouts.app')

@section('content')
<style>
    .mainpage-title{
        color: #c08d00;
    }

    .guest-selector {
    position: relative;
    font-family: Arial, sans-serif;
    width: 100%;
    }

    .guest-summary {
    display: flex;
    align-items: center;
    padding: 0;
    background: transparent;
    text-decoration: none;
    color: inherit;
    gap: 8px;
    border: none;
    width: 100%;
    }

    .icon { font-size: 20px; margin-right: 10px; }
    .text { flex: 1; }
    .arrow { font-size: 12px; }

    .guest-dropdown {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        width: 100%;
        border: 1px solid #febb02;
        background: #fff;
        padding: 10px;
        z-index: 9999;
        border-radius: 10px
    }

    .guest-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    }

    .row select { width: 80px; }

    .actions {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
    margin-top: 10px;
    }

    .cancel {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border: 1px solid #ccc;
    text-decoration: none;
    color: inherit;
    }

    .search-bar{
        border: 2px solid #febb02;
        overflow: visible;
    }

    .search-box{
        height: 64px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 12px;
        border-right: 1px solid #ddd;
        background: #fff;
    }

  .guest-btn{
    background-color: #febb02;
    color: white;
    border: 1px solid #febb02;
    border-radius: 4px;
  }

</style>
<div class="mainpage-title pt-2 h1 text-center">{{ __('Welcome to WonderStay') }}</div>
<div class="mainpage-title pt-3 pb-4 h4 text-center">{{ __('Please find your dream stay') }}</div>

<div class="container mx-auto">
  <div class="row g-0 align-items-center search-bar">

    <!-- destination -->
    <div class="col-3">
      <div class="search-box">
        <i class="bi bi-search text-secondary"></i>
        <span>{{ __('Enter a destination or property') }}</span>
      </div>
    </div>

    <!-- date -->
    <div class="col-3">
        <div class="search-box">
            <i class="bi bi-calendar3 text-secondary"></i>
            <input type="date" class="form-control border-0 p-0 shadow-none">
            <span class="vr mx-0"></span>
            <i class="bi bi-calendar3 text-secondary"></i>
            <input type="date" class="form-control border-0 p-0 shadow-none">
        </div>
    </div>

    <!-- people / rooms -->
    <div class="col-3">
      @php
        $people = (int) request('people', 2);
        $rooms  = (int) request('rooms', 1);
        $open   = (int)request('guest_open', 0) === 1;
      @endphp

      <div class="search-box guest-selector">
        <a class="guest-summary"
           href="{{ route('main', [
            'guest_open' => $open ? 0 : 1,
            'people' => $people,
            'rooms' => $rooms]) }}">
          <span class="icon">👤</span>

          <div class="text">
            <div>{{ $people }} {{ __('people') }}</div>
            <div>{{ $rooms }} {{ __('room(s)') }}</div>
          </div>

          <span class="arrow ms-auto">▼</span>
        </a>

        @if($open)
          <div class="guest-dropdown">
            <form method="GET" action="{{ url()->current() }}">
              @foreach(request()->except(['people','rooms','guest_open']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
              @endforeach

              <div class="guest-row">
                <label>{{ __('People') }}</label>
                <select name="people">
                  @for($i=1; $i<=10; $i++)
                    <option value="{{ $i }}" @selected($people === $i)>{{ $i }}</option>
                  @endfor
                </select>
              </div>

              <div class="guest-row">
                <label>{{ __('Rooms') }}</label>
                <select name="rooms">
                  @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}" @selected($rooms === $i)>{{ $i }}</option>
                  @endfor
                </select>
              </div>

              <div class="d-flex justify-content-end gap-2">
                <button type="submit" name="guest_open" value="0" class="btn guest-btn btn-sm">{{ __('Apply') }}</button>
                <a class="btn btn-outline-secondary btn-sm"
                   href="{{ url()->current() }}?guest_open={{ $open ? 0 : 1 }}&people={{ $people }}&rooms={{ $rooms }}">{{ __('Close') }}</a>
              </div>
            </form>
          </div>
        @endif
      </div>
    </div>

    <!-- search button -->
    <div class="col-3">
        <div class="search-box justify-content-center border-right-0">
            <button class="btn px-4 fw-semibold search-bar-btn" type="button">
                <i class="bi bi-search text-dark"></i>
            </button>
        </div>
    </div>
  </div>
</div>


@endsection
