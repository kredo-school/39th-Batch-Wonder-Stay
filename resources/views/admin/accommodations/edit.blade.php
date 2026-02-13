@extends('layouts.admin')

@section('title', 'Admin | Accommodations')

@section('content')
    <h1 style="margin:0 0 16px 0;">Edit Room</h1>

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
        {{-- Edit accomodation form --}}
     <form method="POST"
      action="{{ route('admin.accommodations.update', $hotelDetail) }}"
      enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            {{-- Hotel --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Hotel
                </label>
                <select name="hotel_id" style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
                    <option value="">-- Select Hotel --</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}"
                            {{ old('hotel_id', $hotelDetail->hotel_id) == $hotel->id ? 'selected' : '' }}>
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
                <input type="text" name="room_number" value="{{ old('room_number', $hotelDetail->room_number) }}"
                    placeholder="e.g. 101" style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
            </div>

            {{-- Price --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Price ($)
                </label>
                <input type="text" name="price" inputmode="decimal" value="{{ old('price', $hotelDetail->price) }}"
                    placeholder="e.g. 120.00" style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
            </div>

            {{-- Size Area --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Size Area (m²)
                </label>
                <input type="text" name="size_area" inputmode="decimal"
                    value="{{ old('size_area', $hotelDetail->size_area) }}" placeholder="e.g. 25.5"
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
                        <option value="{{ $i }}"
                            {{ old('capacity', $hotelDetail->capacity) == $i ? 'selected' : '' }}>
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
                        <option value="{{ $type }}"
                            {{ old('bed_type', $hotelDetail->bed_type) === $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Aminities --}}
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

                $selectedAmenities = array_filter(
                    array_map('trim', explode(',', old('amenities', $hotelDetail->amenities ?? ''))),
                );
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

            {{-- ✅ Photos Preview --}}
            @if($hotelDetail->photos->count())

                <div style="margin-bottom:16px;">
                    <label style="font-weight:600;">Uploaded Photos</label>

                    <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:8px;">

                        @foreach($hotelDetail->photos as $photo)

                            <img src="{{ asset('storage/' . $photo->path) }}"
                                style="
                                    width:70px;
                                    height:70px;
                                    object-fit:cover;
                                    border-radius:8px;
                                    border:1px solid #ddd;
                                ">

                        @endforeach

                    </div>
                </div>

            @endif

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

        </form>

    </div>
@endsection
