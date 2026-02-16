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

    @php
        $mainPhoto = $hotelDetail->photos->firstWhere('is_main', true);
    @endphp

    <div style="margin-bottom:20px;">

        <label style="
            font-weight:600;
            display:block;
            margin-bottom:10px;
            font-size:16px;
        ">
            Uploaded Photos
        </label>

        {{-- delete panel --}}
<div id="deletePanel" style="
    display:none;
    margin-top:14px;
    padding:12px;
    border:1px solid #ddd;
    border-radius:12px;
    background:#fafafa;
">

 <div style="font-weight:600; margin-bottom:10px; color:#d9534f;">
    Select photo to delete
</div>


    <div style="display:flex; gap:10px; flex-wrap:wrap;">

      @foreach($hotelDetail->photos as $photo)

    <img id="photo-{{ $photo->id }}"
         src="{{ asset('storage/' . $photo->path) }}"
         onclick="deletePhoto({{ $photo->id }})"

                 style="
                    width:75px;
                    height:75px;
                    object-fit:cover;
                    border-radius:10px;
                    border:1px solid #ccc;
                    cursor:pointer;
                    transition:0.2s;
                 "
                 onmouseover="this.style.transform='scale(1.08)'"
                 onmouseout="this.style.transform='scale(1)'"
            >

        @endforeach

    </div>

</div>
        {{-- ✅ MAIN PHOTO --}}
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

        {{-- ✅ OTHER PHOTOS --}}
        <div style="
            display:flex;
            gap:10px;
            overflow-x:auto;
            padding:4px 0;
        ">

            @foreach($hotelDetail->photos->where('is_main', false) as $photo)

                <img src="{{ asset('storage/' . $photo->path) }}"
                     onclick="setMainPhoto({{ $photo->id }})"
                     style="
                        width:75px;
                        height:75px;
                        object-fit:cover;
                        border-radius:12px;
                        border:2px solid #ddd;
                        cursor:pointer;
                        transition:0.2s;
                     "
                     onmouseover="this.style.transform='scale(1.08)'"
                     onmouseout="this.style.transform='scale(1)'"
                >

            @endforeach

              {{-- ✅ LIVE PREVIEW AREA --}}
<div id="previewContainer" style="
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:12px;
"></div>

        </div>

    </div>

@endif

<div style="
    display:flex;
    gap:10px;
    margin-top:10px;
">

    {{-- ✅ ADD BUTTON --}}
    <button type="button"
        onclick="document.getElementById('photoInput').click();"
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
  

    <input type="file"
       id="photoInput"
       name="photos[]"
       multiple
       accept="image/*"
       style="display:none;"
       onchange="previewImages(event)">

<script>
function previewImages(event)
{
    const container = document.getElementById('previewContainer');
    const files = event.target.files;

    for (let i = 0; i < files.length; i++)
    {
        const file = files[i];

        if (!file.type.startsWith('image/')) continue;

        const reader = new FileReader();

        reader.onload = function(e)
        {
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


    {{-- ✅ DELETE BUTTON --}}
    @if($mainPhoto)
   <button type="button"
    onclick="openDeleteModal()"
    style="
        width:90px;
        height:44px;
        border:1px solid #d9534f;
        border-radius:12px;
        background:#fff;
        color:#d9534f;
        font-weight :600;
        cursor:pointer;
">
    Delete
</button>


    @endif

</div>




<script>
function setMainPhoto(photoId)
{
    fetch('/admin/room-photos/' + photoId + '/main', {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (res.ok) location.reload();
    });
}

function deleteMainPhoto(photoId)
{
    if (!confirm('Delete main photo?')) return;

    fetch('/admin/room-photos/' + photoId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (res.ok) location.reload();
    });
}

// delete panel
function openDeletePanel()
{
    const panel = document.getElementById('deletePanel');

    panel.style.display =
        panel.style.display === 'none' ? 'block' : 'none';
}

function deletePhoto(photoId)
{
    if (!confirm('Delete this photo?')) return;

    fetch('/admin/room-photos/' + photoId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => {

        if (res.ok)
        {
            const img = document.getElementById('modal-photo-' + photoId);

            if (img) img.remove();
        }

    });
}



function openDeleteModal()
{
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal()
{
    document.getElementById('deleteModal').style.display = 'none';
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

        </form>

    </div>

    <div id="deleteModal" style="
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.35);
    z-index:999;
    align-items:center;
    justify-content:center;
">

  <div style="
    width:720px;
    max-height:520px;
    background:white;
    border-radius:16px;
    padding:20px;
    box-shadow:0 20px 40px rgba(0,0,0,0.25);
    overflow-y:auto;
    border:2px solid #d9534f;
">


        <div style="
            font-size:18px;
            font-weight:600;
            margin-bottom:16px;
            color:#d9534f;
        ">
            Select photo to delete
        </div>

        <div style="
            display:flex;
            gap:12px;
            flex-wrap:wrap;
        ">

           @foreach($hotelDetail->photos as $photo)

    <img id="modal-photo-{{ $photo->id }}"
         src="{{ asset('storage/' . $photo->path) }}"
         onclick="deletePhoto({{ $photo->id }})"

                     style="
                        width:90px;
                        height:90px;
                        object-fit:cover;
                        border-radius:12px;
                        cursor:pointer;
                        border:2px solid #eee;
                        transition:0.2s;
                     "
                     onmouseover="this.style.transform='scale(1.05)'"
                     onmouseout="this.style.transform='scale(1)'"
                >

            @endforeach

        </div>

        <div style="
            display:flex;
            justify-content:flex-end;
            margin-top:20px;
        ">
            <button onclick="closeDeleteModal()"style="
                    padding:10px 18px;
                    border:1px solid #4b4f57;
                    border-radius:10px;
                    background:#4b4f57;
                    color:white;
                    font-weight:600;
                    cursor:pointer;
                    transition:0.2s;
                "
                onmouseover="this.style.opacity='0.85'"
                onmouseout="this.style.opacity='1'">
                Close
            </button>

        </div>

    </div>
</div>

@endsection
