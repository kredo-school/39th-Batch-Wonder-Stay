<h1 style="margin:0 0 16px;">Admin accommodation</h1>

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

            {{-- ✅ Add Room button（ここ） --}}
            <a href="{{ route('admin.accommodations.create', ['hotel_id' => $hotelId]) }}"
                style="padding:6px 12px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
                Add Room +
            </a>

        </div>

        @if (session('success'))
            <div style="margin-bottom:12px; color:green;">
                {{ session('success') }}
            </div>
        @endif


        {{-- Table --}}
        <div style="border:1px solid #bbb; border-radius:10px; overflow:hidden;">
            <table style="width:100%; border-collapse:collapse;">

                <thead>
                    <tr style="background:#f5f5f5;">
                        <th style="text-align:left; padding:10px;">Room Name</th>
                        <th style="text-align:left; padding:10px;">Room No</th>
                        <th style="text-align:left; padding:10px;">Status</th>
                        <th style="text-align:left; padding:10px; white-space:nowrap;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rooms as $room)
                        <tr>
                            <td style="padding:10px;">
                                {{ $room->bed_type ?? '-' }}
                            </td>

                            <td style="padding:10px;">
                                {{ $room->room_number ?? '-' }}
                            </td>

                            <td style="padding:10px;">
                                -
                            </td>

                            {{-- ✅ Actions 列（ここ！） --}}
                            <td style="padding:10px; white-space:nowrap;">
                                <a href="{{ route('admin.accommodations.edit', $room) }}"
                                    style="margin-right:6px; text-decoration:none;">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.accommodations.destroy', $room) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" disabled title="DB not ready yet"
                                        style="background:none; border:none; color:#aaa; cursor:not-allowed;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:14px; text-align:center; color:#666;">
                                No rooms found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


    </main>
</div>
