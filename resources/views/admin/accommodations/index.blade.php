@extends('layouts.admin')

@section('title', 'Admin | Accommodations')

@section('content')

    <div style="display:flex; gap:16px;">

        {{-- Sidebar --}}
        <aside
            style="
    width:220px;
    background:#2f2f2f;
    color:#fff;
    padding:14px;
    border-radius:10px;
  ">
            <div style="font-weight:700; margin-bottom:12px;">
                Accommodation List
            </div>

            <form method="GET" action="{{ route('admin.accommodations.index') }}" style="margin:0;">

                {{-- Country --}}
                <div style="margin-bottom:10px;">
                    <label style="font-size:13px;">Select Country</label>
                    <select name="country_id" onchange="this.form.submit()"
                        style="width:100%; padding:6px; border-radius:6px;">
                        <option value="">All</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ (string) $country->id === (string) $countryId ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Hotel --}}
                <div style="margin-bottom:10px;">
                    <label style="font-size:13px;">Select Hotel</label>
                    <select name="hotel_id" onchange="this.form.submit()"
                        style="width:100%; padding:6px; border-radius:6px;">
                        <option value="">All</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}"
                                {{ (string) $hotel->id === (string) $hotelId ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Keep search when auto submit --}}
                <input type="hidden" name="search" value="{{ $search }}">
            </form>
        </aside>

        {{-- Main --}}
        <main style="flex:1;">

            {{-- Top bar --}}
            <div style="
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:12px;
">

                {{-- Search --}}
                <form method="GET" action="{{ route('admin.accommodations.index') }}"
                    style="margin:0; display:flex; gap:8px; align-items:center;">
                    <input type="hidden" name="country_id" value="{{ $countryId }}">
                    <input type="hidden" name="hotel_id" value="{{ $hotelId }}">

                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by ID or Name"
                        style="padding:6px 10px; width:240px; border-radius:8px; border:1px solid #bbb;">

                    <button type="submit"
                        style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
                        Search
                    </button>
                </form>

               {{-- ✅ Add Room button (UPDATED) --}}
<a href="{{ route('admin.accommodations.create', ['hotel_id' => $hotelId]) }}"
    style="padding:6px 10px; border:1px solid #1f1d1d; border-radius:8px; text-decoration:none;">
    Add +
</a>

</div>

{{-- Table --}}
<div style="border:1px solid #bbb; border-radius:10px; overflow:hidden;">
    <table style="width:100%; border-collapse:collapse;">

        <thead>
            <tr style="background:#f5f5f5;">
                <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Hotel</th>
                <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Room No</th>
                <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Status</th>
                <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Actions</th>
            </tr>
        </thead>

        <tbody>
            {{-- Loop through each room --}}
            @forelse ($rooms as $room)
                <tr>

                    {{-- Hotel --}}
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $room->hotel->name ?? '-' }}
                    </td>

                    {{-- Room No --}}
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $room->room_number ?? '-' }}
                    </td>

                    {{-- Status --}}
                   <td style="padding:10px; border-bottom:1px solid #eee;">

                        <form method="POST"
                            action="{{ route('admin.accommodations.toggle', $room) }}"
                            style="display:inline;">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                style="
                                    padding:4px 10px;
                                    border-radius:20px;
                                    border:1px solid {{ $room->is_active ? '#198754' : '#dc3545' }};
                                    background:#fff;
                                    color:{{ $room->is_active ? '#198754' : '#dc3545' }};
                                    font-size:12px;
                                    font-weight:600;
                                    cursor:pointer;
                                ">
                                {{ $room->is_active ? 'Available' : 'Unavailable' }}
                            </button>
                        </form>

                    </td>

                    {{-- Actions --}}
                    <td style="padding:10px; border-bottom:1px solid #eee; white-space:nowrap;">
                        <div style="display:flex; gap:6px; align-items:center;">

                            {{-- Edit --}}
                            <a href="{{ route('admin.accommodations.edit', $room) }}"
                                style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            {{-- Delete (modal open) --}}
                            <button type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#delete-room-{{ $room->id }}"
                                style="
                                    padding:4px 8px;
                                    border:1px solid #dc3545;
                                    border-radius:8px;
                                    background:#fff;
                                    cursor:pointer;
                                    color:#dc3545;
                                ">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="delete-room-{{ $room->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-danger">

                                        <div class="modal-header border-danger">
                                            <h3 class="h5 modal-title text-danger">
                                                <i class="fa-solid fa-circle-exclamation"></i> Delete Room
                                            </h3>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this room?</p>
                                            <p class="mb-0 text-muted">
                                                <strong>
                                                    {{ $room->hotel->name }} / Room {{ $room->room_number }}
                                                </strong>
                                            </p>
                                        </div>

                                        <div class="modal-footer border-0">
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm"
                                                data-bs-dismiss="modal">
                                                Cancel
                                            </button>

                                            <form method="POST"
                                                action="{{ route('admin.accommodations.destroy', $room) }}"
                                                style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4"
                        style="padding:14px; text-align:center; color:#666;">
                        No rooms found.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

{{-- Pagination --}}
<div style="margin-top:20px; display:flex; justify-content:center;">
    {{ $rooms->links('pagination::bootstrap-5') }}
</div>

@endsection
