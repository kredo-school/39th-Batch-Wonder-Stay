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

  .list-of-hotels-title {
  width: 650px;                 /* ← 下線の長さ */
  margin: 0 auto;               /* ← 中央寄せ（外枠と揃う） */
  padding-bottom: 4px;
  border-bottom: 2px solid #000;
}

</style>
<div class="mainpage-title pt-2 h1 text-center">{{ __('Welcome to WonderStay') }}</div>
<div class="mainpage-title pt-3 pb-4 h4 text-center">{{ __('Please find your dream stay') }}</div>

<div class="container mx-auto">
  <form action="{{ route('hotels.search') }}" method="GET">
    <div class="row g-0 align-items-center search-bar">

      <!-- destination -->
      <div class="col-3">
        <div class="search-box">
          <i class="bi bi-search text-secondary"></i>
          <input type="text" name="destination" class="form-control border-0 p-0 shadow-none" placeholder="{{ __('Enter a destination or property') }}" value="{{ request('keyword') }}">
        </div>
      </div>

      <!-- date -->
      <div class="col-3">
          <div class="search-box">
              <i class="bi bi-calendar3 text-secondary"></i>
              <input type="date" name="checkin" class="form-control border-0 p-0 shadow-none" value="{{ request('checkin-date') }}">
              <span class="vr mx-0"></span>
              <i class="bi bi-calendar3 text-secondary"></i>
              <input type="date" name="checkout" class="form-control border-0 p-0 shadow-none" value="{{ request('checkout-date') }}">
          </div>
      </div>

      <!-- people -->
      <div class="col-3">
        @php
          $people = (int) request('people', 2);
        @endphp

        <div class="search-box guest-selector">

          <input type="hidden" name="people" id="peopleInput" value="{{ $people }}">

          <span class="icon">👤</span>
          <div class="text">
            <div id="peopleText">{{ $people }} {{ __('People') }}</div>
          </div>
          <select id="peopleSelect" class="form-select border-0 shadow-none">
            @for($i=1; $i<=4; $i++)
              <option value="{{ $i }}" @selected($people === $i)>{{ $i }}</option>
            @endfor
          </select>
        </div>
      </div>

      <!-- search button -->
      <div class="col-3">
          <div class="search-box justify-content-center border-right-0">
              <button class="btn px-4 fw-semibold search-bar-btn" type="submit">
                  <i class="bi bi-search text-dark"></i>
              </button>
          </div>
      </div>
    </div>
  </form>
</div>

<!-- Map page & List of hotels -->
<div class="container mt-5">
  <div class="row align-items-start">

    <!-- 左：Map（縦に固定） -->
    <div class="col-6 text-center">
      <a href="{{ route('map.index') }}"
         class="btn btn-lg btn-outline-black px-0 pb-0 border-2 border-black w-100">
        <span class="d-block mb-0 pb-1 border-2 border-black border-bottom h3">
          {{ __('View on Map page') }}
        </span>

        <img src="{{ asset('images/world-map.png') }}"
             alt="World-map"
             class="img-fluid"
             style="height: 520px; object-fit: cover; border-radius: 7px; border-top-left-radius: 0; border-top-right-radius: 0;">
      </a>
    </div>

    <!-- 右：上にボタン、下にRegion+Hotels -->
    <div class="col-6">
      <div class="border rounded-3 rounded-bottom-0 border-2 border-black pt-2">
        <!-- タイトル（枠いっぱいに中央） -->
        <div class="list-of-hotels-title h3 text-center w-100 mb-0">
          {{ __('View List of Hotels') }}
        </div>
        <!-- Region + Hotels（枠の中で左右余白なし） -->
        <div class="row gx-0 mt-0">
          <!-- Region -->
          <div class="col-4 px-0">
            <div class="list-group rounded-0" id="regionList">
              @foreach($regions as $region)
                <button type="button"
                  class="list-group-item list-group-item-action bg-light text-dark region-btn rounded-0"
                  data-region-id="{{ $region->id }}">
                  {{ $region->name }}
                </button>
              @endforeach
            </div>
          </div>

          <!-- Hotels -->
          <div class="col-8 px-0">
            <div class="card rounded-0 border-black">
              <div class="card-header fw-bold" id="hotelTitle">{{ __('Hotels') }}</div>
              <div class="card-body">
                <ul class="list-group" id="hotelList">
                  <li class="list-group-item text-muted">{{ __('Please select the region') }}</li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div><!-- /row -->


        

        {{-- Laravelからデータ渡す --}}
        <script>
          const regions = @json($regions);
          const hotels  = @json($hotels);

          const hotelTitle = document.getElementById('hotelTitle');
          const hotelList  = document.getElementById('hotelList');

          function renderHotels(regionId) {
            const region = regions.find(r => r.id === Number(regionId));
            const filtered = hotels.filter(h => h.region_id === Number(regionId));

            hotelTitle.textContent = region ? `${region.name} Hotels` : 'Hotels';
            hotelList.innerHTML = '';

            if (filtered.length === 0) {
              hotelList.innerHTML = `<li class="list-group-item text-muted">{{ __('No hotels in this region') }}</li>`;
              return;
            }

            filtered.forEach(h => {
              const li = document.createElement('li');
              li.className = 'list-group-item d-flex justify-content-between align-items-center';
              li.innerHTML = `
                <span>${h.name}</span>
                <a class="btn btn-sm btn-outline-dark" href="/hotels/${h.id}">View</a>
              `;
              hotelList.appendChild(li);
            });
          }

          // クリックで切替 + アクティブ表示
          document.querySelectorAll('.region-btn').forEach(btn => {
            btn.addEventListener('click', () => {
              document.querySelectorAll('.region-btn').forEach(b => b.classList.remove('active'));
              btn.classList.add('active');
              renderHotels(btn.dataset.regionId);
            });
          });

          // 初期表示（最初のRegionを自動選択したい場合）
          const first = document.querySelector('.region-btn');
          if (first) first.click();
        </script>
</div>
<script>
  const select = document.getElementById('peopleSelect');
  const input  = document.getElementById('peopleInput');
  const text   = document.getElementById('peopleText');

  select.addEventListener('change', () => {
    input.value = select.value;
    text.textContent = select.value + ' People';
  });
</script>

@endsection
