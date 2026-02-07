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

    <form method="POST" action="{{ route('admin.accommodations.store') }}">
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
                Price
            </label>
            <input type="text" name="price" inputmode="decimal" placeholder="e.g. 120.00"
                style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">

        </div>

        {{-- Size Area --}}
        <div style="margin-bottom:14px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Size Area
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


        {{-- Amenities (textarea for now) --}}
        <div style="margin-bottom:16px;">
            <label style="display:block; margin-bottom:6px; font-weight:600;">
                Amenities
            </label>
            <textarea name="amenities" rows="4" placeholder="e.g. WiFi, TV, Aircon"
                style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">{{ old('amenities') }}</textarea>
            <div style="font-size:12px; color:#666; margin-top:6px;">
                (Step 5+) We can convert this into checkbox UI later.
            </div>
        </div>

        {{-- Buttons --}}
        <div style="display:flex; gap:10px;">
            <button type="submit"
                style="padding:8px 12px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
                Save
            </button>

            <a href="{{ route('admin.accommodations.index') }}"
                style="padding:8px 12px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
                Cancel
            </a>
        </div>

    </form>
</div>
