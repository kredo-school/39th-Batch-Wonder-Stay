<h1 style="margin:0 0 16px 0;">Hotels</h1>

<div style="display:flex; gap:16px;">

  {{-- Main --}}
  <main style="flex:1;">

    {{-- Top bar --}}
    <div style="
        display:flex;
        justify-content:flex-end;
        gap:10px;
        margin-bottom:12px;
      ">
      <span style="padding:6px 10px; border:1px solid #bbb; border-radius:8px;">Admin</span>
    </div>

    {{-- Actions row (Country dropdown + Search on left / Add+ on right) --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

      {{-- Filters --}}
      <form method="GET" action="{{ route('admin.hotels.index') }}"
            style="margin:0; display:flex; gap:10px; align-items:center;">

        {{-- Country dropdown --}}
        <select name="country_id"
                style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; min-width:220px;">
          <option value="">Select Countries</option>
          @foreach ($countries as $country)
            <option value="{{ $country->id }}"
              {{ (string)$country->id === (string)$countryId ? 'selected' : '' }}>
              {{ $country->name }}
            </option>
          @endforeach
        </select>

        {{-- Search --}}
        <input type="text"
               name="search"
               value="{{ $search }}"
               placeholder="Search hotel name"
               style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; width:240px;">

        <button type="submit"
                style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
          Apply
        </button>

        <a href="{{ route('admin.hotels.index') }}"
           style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
          Reset
        </a>

      </form>

      {{-- Add button --}}
      <a href="{{ route('admin.hotels.create') }}"
         style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
        Add +
      </a>
    </div>

    {{-- Table --}}
    <div style="border:1px solid #bbb; border-radius:10px; overflow:hidden;">
      <table style="width:100%; border-collapse:collapse;">
        <thead>
          <tr style="background:#f5f5f5;">
            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Hotel</th>
            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Country</th>

            {{-- ✅ Region → City --}}
            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">City</th>

            <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd; white-space:nowrap;">Actions</th>
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

              {{-- ✅ Region表示をやめて City表示に変更（null安全） --}}
              <td style="text-align:left; padding:10px; border-bottom:1px solid #eee;">
                {{ $hotel->city?->name ?? '-' }}
              </td>

              <td style="text-align:left; padding:10px; border-bottom:1px solid #eee; white-space:nowrap;">
                <div style="display:flex; gap:6px; align-items:center;">

                  <a href="{{ route('admin.hotels.edit', $hotel) }}"
                     style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
                    Edit
                  </a>

                  <form method="POST" action="{{ route('admin.hotels.destroy', $hotel) }}"
                        style="display:inline; margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Delete this hotel?')"
                            style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
                      Delete
                    </button>
                  </form>

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
