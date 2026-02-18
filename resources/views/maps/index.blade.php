@extends('layouts.app')

@section('title', 'Hotel Listings')

@section('content')
<style>
  .map-wrap{
    width: 420px;
    margin: 0 auto;
    text-align:center;
  }
  .map-header{
    background:#a89a82;
    color:#fff;
    border-radius:14px 14px 0 0;
    padding:12px 16px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:26px;
  }
  .map-box{
    position:relative;
    width:420px;
    height:300px;
    background:#fff;
    border:2px solid #333;
    border-top:none;
    border-radius:0 0 14px 14px;
    overflow:hidden;
  }
  .map-img{
    width:100%;
    height:100%;
    object-fit:contain;
    display:block;
  }
  .star{
    position:absolute;
    transform:translate(-50%,-50%);
    font-size:22px;
    cursor:pointer;
    user-select:none;
    color:#D4AF37;
    text-shadow:0 2px 6px rgba(0,0,0,.45);
  }
  .star.active{
    transform:translate(-50%,-50%) scale(1.25);
    color:#FFD56A;
    text-shadow: 0 3px 10px rgba(0,0,0,.55), 0 0 10px rgba(255, 213, 106, .35);
  }

  .hotel-panel{
    width:1000px;
    max-width:95vw;
    margin: 28px auto 0;
    background:#a89a82;
    border-radius:18px;
    padding:18px 22px;
    color:#fff;
  }
  .hotel-panel-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:34px;
    margin-bottom:10px;
  }
  .hotel-body{
    display:flex;
    gap:18px;
    align-items:center;
  }
  .hotel-img{
    width:260px;
    height:150px;
    object-fit:cover;
    border-radius:8px;
    border:2px solid rgba(255,255,255,.25);
    background:#ddd;
  }
  .hotel-text{
    flex:1;
    line-height:1.9;
    font-size:16px;
    color:#F5F1E8;
    text-align:left;
  }
  .hotel-text > div{
    padding:8px 0;
    border-bottom:1px solid rgba(255,255,255,.12);
  }
  .hotel-text .k{
    display:block;
    font-size: 13px;
    letter-spacing:.08em;
    color:#E6C36A; /* champagne gold */
    margin-bottom: 2px;
  }
  .hotel-text .v{
    display:block;
    color:#FFF7E6; /* warm ivory */
  }
  .actions{
    width:820px;
    max-width:95vw;
    margin:18px auto 0;
    display:flex;
    justify-content:space-between;
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
    font-size:20px;
    border:2px solid rgba(255,255,255,.2);
  }
  .btn-ws.primary{
    background:#b28b33;
  }
  #hotelName{
    font-weight:700;
    letter-spacing:.02em;
    color:#FFF7E6;
    text-shadow:0 2px 8px rgba(0,0,0,.35);
  }
</style>

@php
  // JSに渡すデータ（必要最小限）
  $hotelJson = $hotels->map(fn($h) => [
      'id' => $h->id,
      'name' => $h->name,
      'continent' => $h->continent,
      'map_x' => $h->map_x,
      'map_y' => $h->map_y,
      'region' => optional($h->region)->name, // region relationあるなら
      'country' => optional($h->country)->name, // country relationあるなら
      'concept' => $h->concept,
      'feature' => $h->feature,
      'service' => is_array($h->service) ? implode(', ', $h->service) : $h->service,
      'description' => $h->description,
      'image' => optional($h->mainPhoto)->path ? asset($h->mainPhoto->path) : null,
      'address' => $h->address,
      'phone'   => $h->phone,
      'email'   => $h->email,
  ]);
@endphp

<div class="map-wrap">
  <div class="map-header">
    <button id="prevCont" type="button" class="btn btn-light btn-sm">◀</button>
    <div id="continentTitle">Asia</div>
    <button id="nextCont" type="button" class="btn btn-light btn-sm">▶</button>
  </div>

  <div class="map-box" id="mapBox">
    <img id="mapImg" class="map-img" src="{{ asset('images/maps/asia.jpg') }}" alt="map">
    <!-- stars are injected here -->
  </div>
</div>

<div class="hotel-panel">
  <div class="hotel-panel-header">
    <button id="prevHotel" type="button" class="btn btn-light btn-sm">◀</button>
    <div id="hotelName"></div>
    <button id="nextHotel" type="button" class="btn btn-light btn-sm">▶</button>
  </div>

  <div class="hotel-body">
    <img id="hotelImg" class="hotel-img" src="" alt="">
    <div class="hotel-text">
      <div id="hotelRegion"><span class="k">Region</span><span class="v"></span></div>
      <div id="hotelConcept"><span class="k">Concept</span><span class="v"></span></div>
      <div id="hotelFeature"><span class="k">Feature</span><span class="v"></span></div>
      <div id="hotelDescription"><span class="k">Description</span><span class="v"></span></div>
      <div id="hotelService"><span class="k">Service</span><span class="v"></span></div>
      <div id="hotelAddress"><span class="k">Address</span><span class="v"></span></div>
      <div id="hotelPhone"><span class="k">Phone</span><span class="v"></span></div>
      <div id="hotelEmail"><span class="k">Email</span><span class="v"></span></div>
    </div>
  </div>
</div>

<div class="actions">
  <a href="{{ url()->previous() }}" class="btn-ws">Back</a>
  <a id="galleryBtn" href="#" class="btn-ws primary">Gallery</a>
  <a href="#" class="btn-ws">Reserve this hotel</a>
</div>

<script>
  const allHotels = @json($hotelJson);
  console.log(allHotels);

  const continents = [
    { key:'Asia',         label:'Asia',         img:'{{ asset("images/maps/asia.jpg") }}' },
    { key:'Europe',       label:'Europe',       img:'{{ asset("images/maps/europe.jpg") }}' },
    { key:'North America', label:'North America',img:'{{ asset("images/maps/north_america.jpg") }}' },
    { key:'South America', label:'South America',img:'{{ asset("images/maps/south_america.jpg") }}' },
    { key:'Africa',       label:'Africa',       img:'{{ asset("images/maps/africa.jpg") }}' },
    { key:'Oceania',      label:'Oceania',      img:'{{ asset("images/maps/oceania.jpg") }}' },
  ];

  let continentIndex = 0;
  let filteredHotels = [];
  let hotelIndex = 0;

  const mapBox = document.getElementById('mapBox');
  const mapImg = document.getElementById('mapImg');
  const continentTitle = document.getElementById('continentTitle');
  const hotelName = document.getElementById('hotelName');
  const hotelImg = document.getElementById('hotelImg');
  const hotelRegion = document.getElementById('hotelRegion');
  const hotelConcept = document.getElementById('hotelConcept');
  const hotelFeature = document.getElementById('hotelFeature');
  const hotelDescription = document.getElementById('hotelDescription');
  const hotelService = document.getElementById('hotelService');
  const hotelAddress = document.getElementById('hotelAddress');
  const hotelPhone   = document.getElementById('hotelPhone');
  const hotelEmail   = document.getElementById('hotelEmail');
  const galleryBtn = document.getElementById('galleryBtn');

  function setContinent(idx){
    continentIndex = (idx + continents.length) % continents.length;
    const c = continents[continentIndex];

    continentTitle.textContent = c.label;
    mapImg.src = c.img;

    filteredHotels = allHotels.filter(h => h.continent === c.key && h.map_x != null && h.map_y != null);
    hotelIndex = 0;

    renderStars();
    renderHotel();
  }

  function clearStars(){
    mapBox.querySelectorAll('.star').forEach(el => el.remove());
  }

  function renderStars(){
    clearStars();
    filteredHotels.forEach((h, idx) => {
      const star = document.createElement('div');
      star.className = 'star' + (idx === hotelIndex ? ' active' : '');
      star.textContent = '★';
      star.style.left = h.map_x + '%';
      star.style.top  = h.map_y + '%';

      star.addEventListener('click', () => {
        hotelIndex = idx;
        renderStars();
        renderHotel();
      });

      mapBox.appendChild(star);
    });
  }

  function renderHotel(){
    if(filteredHotels.length === 0){
      hotelName.textContent = '';
      hotelImg.src = '';
      hotelRegion.querySelector('.v').textContent = 'No hotels in this continent yet.';
      hotelConcept.querySelector('.v').textContent = '';
      hotelFeature.querySelector('.v').textContent = '';
      hotelDescription.querySelector('.v').textContent = '';
      hotelService.querySelector('.v').textContent = '';
      hotelAddress.querySelector('.v').textContent = '';
      hotelPhone.querySelector('.v').textContent = '';
      hotelEmail.querySelector('.v').textContent = '';
      galleryBtn.href = '#';
      return;
    }

    const h = filteredHotels[hotelIndex];

    hotelImg.src = h.image ?? '';
    hotelName.textContent = h.name ?? '';
    hotelRegion.querySelector('.v').textContent  =  `${h.region ?? ''}${h.country ? ', ' + h.country : ''}`;
    hotelConcept.querySelector('.v').textContent = h.concept ?? '';
    hotelFeature.querySelector('.v').textContent = h.feature ?? '';
    hotelService.querySelector('.v').textContent = h.service ?? '';
    hotelDescription.querySelector('.v').textContent = h.description ?? '';
    hotelAddress.querySelector('.v').textContent = h.address ?? '';
    hotelPhone.querySelector('.v').textContent = h.phone ?? '';
    hotelEmail.querySelector('.v').textContent = h.email ?? '';
    galleryBtn.href = `/hotels/${h.id}`; // show.blade.phpへ
  }

  document.getElementById('prevCont').addEventListener('click', () => setContinent(continentIndex - 1));
  document.getElementById('nextCont').addEventListener('click', () => setContinent(continentIndex + 1));

  document.getElementById('prevHotel').addEventListener('click', () => {
    if(filteredHotels.length === 0) return;
    hotelIndex = (hotelIndex - 1 + filteredHotels.length) % filteredHotels.length;
    renderStars();
    renderHotel();
  });

  document.getElementById('nextHotel').addEventListener('click', () => {
    if(filteredHotels.length === 0) return;
    hotelIndex = (hotelIndex + 1) % filteredHotels.length;
    renderStars();
    renderHotel();
  });

  // 初期表示
  setContinent(0);

  // ===== DEBUG: map click position getter =====
    mapBox.addEventListener('click', function(e){

        const rect = mapBox.getBoundingClientRect();

        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        console.log(
            'map_x:', x.toFixed(2),
            'map_y:', y.toFixed(2)
        );

    });
</script>
@endsection
