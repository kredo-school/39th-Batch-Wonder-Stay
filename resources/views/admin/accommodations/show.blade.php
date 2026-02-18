@extends('layouts.admin')

@section('title', 'Admin | Room Details')

@section('content')
    <h1 style="margin:0 0 16px 0;">Room Details</h1>

    <div style="
        max-width: 720px;
        border:1px solid #bbb;
        border-radius:10px;
        padding:16px;
        background:#fff;
    ">

        {{-- Hotel --}}
        <div style="margin-bottom:14px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Hotel
            </label>

            <select disabled
                style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px; background:#f5f5f5;">

                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}"
                        {{ $hotelDetail->hotel_id == $hotel->id ? 'selected' : '' }}>
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

            <input type="text"
                   value="{{ $hotelDetail->room_number }}"
                   readonly
                   style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px; background:#f5f5f5;">
        </div>

        {{-- Price --}}
        <div style="margin-bottom:14px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Price ($)
            </label>

            <input type="text"
                   value="{{ $hotelDetail->price }}"
                   readonly
                   style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px; background:#f5f5f5;">
        </div>

        {{-- Size Area --}}
        <div style="margin-bottom:14px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Size Area (m²)
            </label>

            <input type="text"
                   value="{{ $hotelDetail->size_area }}"
                   readonly
                   style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px; background:#f5f5f5;">
        </div>

        {{-- Capacity --}}
        <div style="margin-bottom:14px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Capacity
            </label>

            <select disabled
                style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px; background:#f5f5f5;">

                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}"
                        {{ $hotelDetail->capacity == $i ? 'selected' : '' }}>
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

            <input type="text"
                   value="{{ $hotelDetail->bed_type }}"
                   readonly
                   style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px; background:#f5f5f5;">
        </div>

        {{-- Amenities --}}
        <div style="margin-bottom:16px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Amenities
            </label>

            <div style="
                border:1px solid #bbb;
                border-radius:8px;
                padding:10px;
                background:#f5f5f5;
            ">
                {{ $hotelDetail->amenities }}
            </div>
        </div>

        {{-- Photos --}}
        @if($hotelDetail->photos->count())

            @php
                $mainPhoto = $hotelDetail->photos->firstWhere('is_main', true);
            @endphp

            <div style="margin-top:20px;">

                <label style="
                    font-weight:600;
                    display:block;
                    margin-bottom:10px;
                    font-size:16px;
                ">
                    Photos
                </label>

                {{-- MAIN PHOTO --}}
                @if($mainPhoto)
                    <div style="margin-bottom:12px;">
                        <img src="{{ asset('storage/' . $mainPhoto->path) }}"
                             style="
                                width:150px;
                                height:150px;
                                object-fit:cover;
                                border-radius:18px;
                                border:2px solid #4b4f57;
                                box-shadow:0 6px 14px rgba(0,0,0,0.18);
                             ">
                    </div>
                @endif

                {{-- OTHER PHOTOS --}}
                <div style="
                    display:flex;
                    gap:10px;
                    flex-wrap:wrap;
                ">

                    @foreach($hotelDetail->photos->where('is_main', false) as $photo)

                        <img src="{{ asset('storage/' . $photo->path) }}"
                             style="
                                width:75px;
                                height:75px;
                                object-fit:cover;
                                border-radius:12px;
                                border:2px solid #ddd;
                             ">

                    @endforeach

                </div>

            </div>

        @endif

        {{-- Back Button --}}
        <div style="display:flex; justify-content:flex-end; margin-top:24px;">

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
               ">
                Back
            </a>

        </div>

    </div>
@endsection
