@extends('layouts.admin')

@section('title', 'Admin | Hotels')

@section('content')

    <h1 style="margin:0 0 16px 0;">Hotels</h1>

    <div style="display:flex; gap:16px; align-items:flex-start;">

        {{-- Sidebar --}}
        <aside
            style="
      width:220px;
      background:#2f2f2f;
      color:#fff;
      padding:14px;
      border-radius:10px;
      height: fit-content;
    ">
            <div style="font-weight:700; margin-bottom:12px;">
                Country List
            </div>

            <form method="GET" action="{{ route('admin.hotels.index') }}" style="margin:0;">

                {{-- Country dropdown --}}
                <div style="font-size:13px; margin-bottom:6px;">Select Country</div>
                <select name="country_id" onchange="this.form.submit()"
                    style="width:100%; padding:8px; border-radius:8px; border:1px solid #555; background:#fff;">

                    <option value="">All</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ (string) $country->id === (string) $countryId ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Keep search value when filtering by country (so it doesn’t reset) --}}
                <input type="hidden" name="search" value="{{ $search }}">

            </form>
        </aside>

        {{-- Main --}}
        <main style="flex:1;">

            {{-- Top row: Search + Add --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; gap:12px;">

                {{-- Search --}}
                <form method="GET" action="{{ route('admin.hotels.index') }}"
                    style="margin:0; display:flex; gap:10px; align-items:center;">

                    {{-- Keep country filter when searching --}}
                    <input type="hidden" name="country_id" value="{{ $countryId }}">

                    <input type="text" name="search" value="{{ $search }}" placeholder="Search hotels"
                        style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; width:260px;">

                    <button type="submit"
                        style="padding:6px 12px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
                        Search
                    </button>
                </form>

                {{-- Add button (black bg) --}}
                <a href="{{ route('admin.hotels.create') }}"
                    style="padding:6px 10px; border:1px solid #1f1d1d; border-radius:8px; text-decoration:none;">
                    Add Hotel +
                </a>
            </div>

            {{-- Table --}}
            <div style="border:1px solid #bbb; border-radius:10px; overflow:hidden;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f5f5f5;">
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Hotel</th>
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Country</th>
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">City</th>
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd; white-space:nowrap;">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($hotels as $hotel)
                            <tr>
                                <td style="text-align:left; padding:10px; border-bottom:1px solid #eee;">
                                    {{ $hotel->name }}
                                </td>

                                <td style="text-align:left; padding:10px; border-bottom:1px solid #eee;">
                                    {{ $hotel->country->name ?? '-' }}
                                </td>

                                <td style="text-align:left; padding:10px; border-bottom:1px solid #eee;">
                                    {{ $hotel->city?->name ?? '-' }}
                                </td>

                                <td
                                    style="text-align:left; padding:10px; border-bottom:1px solid #eee; white-space:nowrap;">
                                    <div style="display:flex; gap:6px; align-items:center;">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.hotels.edit', $hotel) }}"
                                            style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        {{-- Delete (modal open) --}}
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete-hotel-{{ $hotel->id }}"
                                            style="padding:4px 8px;border:1px solid #dc3545;border-radius:8px;background:#fff;cursor:pointer;color:#dc3545;">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="delete-hotel-{{ $hotel->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-danger">
                                                    <div class="modal-header border-danger">
                                                        <h3 class="h5 modal-title text-danger">
                                                            <i class="fa-solid fa-circle-exclamation"></i> Delete Hotel
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this hotel?</p>
                                                        <p class="mb-0 text-muted"><strong>{{ $hotel->name }}</strong></p>
                                                    </div>

                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>

                                                        <form method="POST"
                                                            action="{{ route('admin.hotels.destroy', $hotel) }}"
                                                            style="margin:0;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
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
                                <td colspan="4" style="padding:14px; text-align:center; color:#666;">
                                    No hotels found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>
@endsection
