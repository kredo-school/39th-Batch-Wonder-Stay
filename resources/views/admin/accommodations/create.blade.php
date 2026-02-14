@extends('layouts.admin')

@section('title', 'Admin | Accommodations')

@section('content')
    <h1 style="margin:0 0 16px 0;">Add Room</h1>

    <div style="
    max-width: 720px;
    border:1px solid #bbb;
    border-radius:10px;
    padding:16px;
  ">

        {{-- Validation error messages --}}
        @if ($errors->any())
            <ul style="margin-bottom:12px; color:#b00020;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('admin.accommodations.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Hotel --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Hotel
                </label>

                <select name="hotel_id" style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
                    <option value="">-- Select Hotel --</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ old('hotel_id', $hotelId) == $hotel->id ? 'selected' : '' }}>
                            {{ $hotel->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Room Number --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Room Number
                </label>
                <input type="text" name="room_number" value="{{ old('room_number') }}" placeholder="e.g. 101"
                    style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
            </div>

            {{-- Price --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Price ($)
                </label>
                <input type="text" name="price" inputmode="decimal" placeholder="e.g. 120.00"
                    style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">

            </div>

            {{-- Size Area --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Size Area (m²)
                </label>
                <input type="text" name="size_area" inputmode="decimal" placeholder="e.g. 25.5"
                    style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">

            </div>

            {{-- Capacity --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Capacity
                </label>

                <select name="capacity" style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
                    <option value="">-- Select Capacity --</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('capacity') == $i ? 'selected' : '' }}>
                            {{ $i }} {{ $i === 1 ? 'person' : 'people' }}
                        </option>
                    @endfor
                </select>
            </div>


            {{-- Bed Type --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Bed Type
                </label>

                <select name="bed_type" style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
                    <option value="">-- Select Bed Type --</option>
                    @foreach (['Single', 'Double', 'Twin', 'Queen', 'King'] as $type)
                        <option value="{{ $type }}" {{ old('bed_type') === $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Amenities --}}
            @php
                $amenityOptions = [
                    'Wi-Fi',
                    'Air Conditioner',
                    'Heating',
                    'TV',
                    'Desk / Work Desk',
                    'Towels',
                    'Wardrobe / Closet',
                ];

                // Create page → no existing data
                $selectedAmenities = old('amenities', []);
            @endphp

            <div style="margin-bottom:16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Amenities
                </label>

                <div
                    style="
        border:1px solid #bbb;
        border-radius:8px;
        padding:10px;
        max-height:160px;
        overflow-y:auto;
    ">
                    @foreach ($amenityOptions as $amenity)
                        <label style="display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                {{ in_array($amenity, $selectedAmenities) ? 'checked' : '' }}>
                            {{ $amenity }}
                        </label>
                    @endforeach
                </div>
            </div>


            {{-- Photos --}}
            <div style="margin-bottom:16px;">

                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Photos
                </label>

                <div style="
        display:flex;
        gap:10px;
        margin-top:6px;
    ">

                    {{-- ✅ ADD BUTTON --}}
                    <button type="button" onclick="document.getElementById('photoInput').click();"
                        style="
                width:130px;
                height:44px;
                border:1px solid #bbb;
                border-radius:12px;
                cursor:pointer;
                background:#fff;
                font-weight:600;
                font-size:14px;
                box-shadow:0 2px 6px rgba(0,0,0,0.08);
            ">
                        ＋ Add Photos
                    </button>

                    <input type="file" id="photoInput" name="photos[]" multiple accept="image/*" style="display:none;"
                        onchange="previewImages(event)">

                </div>

                {{-- ✅ LIVE PREVIEW --}}
                <div id="previewContainer"
                    style="
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        margin-top:12px;
    ">
                </div>

                {{-- Hidden --}}
                <input type="hidden" name="is_active" value="1">

            </div>
            {{-- JS --}}
            <script>
                function previewImages(event) {
                    const container = document.getElementById('previewContainer');
                    container.innerHTML = '';

                    const files = event.target.files;

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        if (!file.type.startsWith('image/')) continue;

                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const img = document.createElement('img');

                            img.src = e.target.result;

                            img.style.width = '75px';
                            img.style.height = '75px';
                            img.style.objectFit = 'cover';
                            img.style.borderRadius = '12px';
                            img.style.border = '2px solid #ddd';
                            img.style.boxShadow = '0 2px 6px rgba(0,0,0,0.08)';

                            container.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    }
                }
            </script>


            {{-- Buttons --}}
            <div style="display:flex; justify-content:flex-end; gap:14px; margin-top:18px;">
                <a href="{{ route('admin.accommodations.index') }}"
                    style="
       padding:10px 22px;
       border:1px solid #bbb;
       border-radius:10px;
       background:#fff;
       color:#111;
       text-decoration:none;
       font-size:16px;
       line-height:1;
       box-shadow:0 1px 0 rgba(0,0,0,.08);
     ">
                    Cancel
                </a>

                <button type="submit"
                    style="
            padding:10px 22px;
            border:1px solid #444;
            border-radius:10px;
            background:#4b4f57;
            color:#fff;
            font-size:16px;
            line-height:1;
            cursor:pointer;
            box-shadow:0 1px 0 rgba(0,0,0,.15);
          ">
                    Save
                </button>
            </div>
    </div>
@endsection
