@extends('layouts.app')

@section('title', 'Hotel Listings')

@section('content')
<style>
  .show-wrap{
    min-height: calc(100vh - 56px);
    padding: 40px 0 60px;
  }

  .hotel-title{
    font-family: serif;
    letter-spacing: .5px;
    font-size: 50px;
    color:#9b9487;
  }

  .slider-row{
    display:flex;
    align-items:center;
    justify-content:center;
    gap: 36px;
    margin-top: 30px;
  }

  .thumb{
    width: 280px;
    height: 230px;
    border-radius: 22px;
    overflow:hidden;
    background:#eee;
    box-shadow: 0 2px 0 rgba(0,0,0,.12) inset;
    opacity:.75;
  }
  .thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }

  .main-photo{
    width: 520px;
    height: 360px;
    border-radius: 26px;
    overflow:hidden;
    background:#eee;
    border: 6px solid rgba(255,255,255,.55);
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
  }
  .main-photo img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }
  .arrow-btn{
    width: 54px;
    height: 54px;
    border-radius: 50%;
    border: 2px solid rgba(0,0,0,.35);
    background: transparent;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size: 22px;
    line-height: 1;
    cursor:pointer;
    user-select:none;
  }
  .arrow-btn:hover{ background: rgba(255,255,255,.35); }

  .btn-row{
    display:flex;
    justify-content:center;
    gap: 280px;
    margin-top: 48px;
  }

  .big-btn{
    width: 360px;
    padding: 16px 20px;
    border-radius: 16px;
    font-size: 28px;
    font-family: serif;
    border: 2px solid rgba(255,255,255,.7);
    box-shadow: 0 6px 18px rgba(0,0,0,.12);
  }
  .btn-back{
    background:#8b7f6c;
    color:#fff;
  }
  .btn-proceed{
    background:#b8943f;
    color:#fff;
  }
  .big-btn:hover{ filter: brightness(.98); }
</style>

@php
  // 写真配列を作る（mainPhotoを先頭に、重複は除く）
  $photos = collect($hotel->photos ?? [])
    ->sortBy('sort_order')
    ->values();

  // asset URL配列
  $photoUrls = $photos->map(fn($p) => asset($p->path))->values();
@endphp
<div class="show-wrap">
  <div class="container">
    <div class="hotel-title">{{ $hotel->name }}</div>

    @if($photoUrls->count() === 0)
      <div class="mt-5 text-muted">No photos.</div>
    @else
      <div class="slider-row">

        {{-- 左サムネ --}}
        <div class="thumb d-none d-md-block">
          <img id="thumbPrev" src="{{ $photoUrls[0] }}" alt="prev">
        </div>

        {{-- 左矢印 --}}
        <button class="arrow-btn" type="button" id="btnPrev" aria-label="Previous photo">
          ◀
        </button>

        {{-- メイン --}}
        <div class="main-photo">
          <img id="mainPhoto" src="{{ $photoUrls[0] }}" alt="main">
        </div>

        {{-- 右矢印 --}}
        <button class="arrow-btn" type="button" id="btnNext" aria-label="Next photo">
          ▶
        </button>
        {{-- 右サムネ --}}
        <div class="thumb d-none d-md-block">
          <img id="thumbNext" src="{{ $photoUrls[0] }}" alt="next">
        </div>

      </div>

      <div class="btn-row">
        {{-- Back：ホテル詳細(index)に戻す（あなたの導線どおり） --}}
        <a class="big-btn btn-back text-decoration-none text-center"
           href="{{ route('hotels.index', $hotel->id) }}">
          Back
        </a>

        {{-- Proceed：予約へ（ルート名はあなたの予約ルートに合わせて変更） --}}
        <a class="big-btn btn-proceed text-decoration-none text-center"
           href="#">
          Proceed to reserve
        </a>
      </div>

      <script>
        const photos = @json($photoUrls);
        // start= が無ければ0、範囲外なら0に丸める
        const startParam = Number(new URLSearchParams(window.location.search).get('start') || 0);
        let idx = (Number.isInteger(startParam) && startParam >= 0 && startParam < photos.length)
            ? startParam
            : 0;

        const mainPhoto = document.getElementById('mainPhoto');
        const thumbPrev = document.getElementById('thumbPrev');
        const thumbNext = document.getElementById('thumbNext');

        function setImages() {
          const prev = (idx - 1 + photos.length) % photos.length;
          const next = (idx + 1) % photos.length;

          mainPhoto.src = photos[idx];
          if (thumbPrev) thumbPrev.src = photos[prev];
          if (thumbNext) thumbNext.src = photos[next];
        }

        document.getElementById('btnPrev').addEventListener('click', () => {
          idx = (idx - 1 + photos.length) % photos.length;
          setImages();
        });

        document.getElementById('btnNext').addEventListener('click', () => {
          idx = (idx + 1) % photos.length;
          setImages();
        });

        // キーボード操作（← →）
        document.addEventListener('keydown', (e) => {
          if (e.key === 'ArrowLeft') document.getElementById('btnPrev').click();
          if (e.key === 'ArrowRight') document.getElementById('btnNext').click();
        });

        setImages();
      </script>
    @endif
  </div>
</div>
@endsection