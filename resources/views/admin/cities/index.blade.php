@extends('layouts.admin')

@section('title', 'Admin | Cities')

@section('content')

    <h1 style="margin:0 0 16px 0;">Regions</h1>
    <div style="display:flex; gap:16px;">

        {{-- Sidebar (Region list mock) --}}
        <aside
            style="
      width:220px;
      background:#2f2f2f;
      color:#fff;
      padding:14px;
      border-radius:10px;
      height: fit-content;
    ">
            <div style="font-weight:700; margin-bottom:10px;">Region List</div>
            <div style="display:flex; flex-direction:column; gap:6px; font-size:14px;">

                @foreach ($regions as $r)
                    <a href="{{ route('admin.cities.index', ['region_id' => $r->id]) }}"
                        style="
         color:#fff; text-decoration:none; padding:6px 8px; border-radius:8px;
         {{ (string) $regionId === (string) $r->id ? 'background:#444;' : '' }}
       ">
                        {{ $r->name }}
                    </a>
                @endforeach

            </div>


        </aside>

        {{-- Main --}}
        <main style="flex:1;">

            {{-- Top bar --}}
            <div style="
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-bottom:12px;
  ">

            </div>


            {{-- Actions row (Country dropdown on the left / Add+ on the right) --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

                {{-- Country filter (auto submit on change) --}}
                <form method="GET" action="{{ route('admin.cities.index') }}" style="margin:0;">

                    {{-- Keep selected region when filtering by country --}}
                    @if (!empty($regionId))
                        <input type="hidden" name="region_id" value="{{ $regionId }}">
                    @endif

                    {{-- Country dropdown --}}
                    <select name="country_id" onchange="this.form.submit()"
                        style="
            padding:6px 10px;
            border:1px solid #bbb;
            border-radius:8px;
            min-width:220px;
          ">
                        <option value="">Select Countries</option>

                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ (string) $countryId === (string) $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>

                </form>



                {{-- Add button --}}
                <a href="{{ route('admin.cities.create') }}"
                    style="padding:6px 10px; border:1px solid #1f1d1d; border-radius:8px; text-decoration:none;">
                    Add +
                </a>
            </div>


            {{-- Table --}}
            <div style="border:1px solid #bbb; border-radius:10px; overflow:hidden;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f5f5f5;">
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Region</th>
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Country</th>
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">City</th>
                            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- Loop through each city --}}
                        @forelse ($cities as $city)
                            <tr>
                                {{-- Display the region name --}}
                                <td style="padding:10px; border-bottom:1px solid #eee;">
                                    {{ $city->region->name ?? '-' }}
                                </td>

                                {{-- Display the country name --}}
                                <td style="padding:10px; border-bottom:1px solid #eee;">
                                    {{ $city->country->name ?? '-' }}
                                </td>

                                {{-- Display the city name --}}
                                <td style="padding:10px; border-bottom:1px solid #eee;">
                                    {{ $city->name }}
                                </td>

                                {{-- Display action buttons: Edit and Delete --}}
                                <td style="padding:10px; border-bottom:1px solid #eee; white-space:nowrap;">
                                    <div style="display:flex; gap:6px; align-items:center;">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.cities.edit', $city) }}"
                                            style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        {{-- Delete (modal open) --}}
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete-city-{{ $city->id }}"
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
                                        <div class="modal fade" id="delete-city-{{ $city->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-danger">
                                                    <div class="modal-header border-danger">
                                                        <h3 class="h5 modal-title text-danger">
                                                            <i class="fa-solid fa-circle-exclamation"></i> Delete City
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this city?</p>
                                                        <p class="mb-0 text-muted">
                                                            <strong>{{ $city->name }}</strong>
                                                        </p>
                                                    </div>

                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>

                                                        <form method="POST"
                                                            action="{{ route('admin.cities.destroy', $city) }}"
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

                                {{-- If there are no cities to display --}}
                            @empty
                            <tr>
                                <td colspan="4" style="padding:14px; text-align:center; color:#666;">
                                    No cities found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>


                </table>
            </div>

        </main>
    </div>
@endsection
