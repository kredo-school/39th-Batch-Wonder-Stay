<h1 style="margin:0 0 16px 0;">Cities</h1>

<div style="display:flex; gap:16px;">

  {{-- Sidebar (Region list mock) --}}
  <aside style="
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
         {{ (string)$regionId === (string)$r->id ? 'background:#444;' : '' }}
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
  <span style="padding:6px 10px; border:1px solid #bbb; border-radius:8px;">Admin</span>
</div>


   {{-- Actions row (Country dropdown on the left / Add+ on the right) --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

 {{-- Country filter (auto submit on change) --}}
<form method="GET"
      action="{{ route('admin.cities.index') }}"
      style="margin:0;">

  {{-- Keep selected region when filtering by country --}}
  @if (!empty($regionId))
    <input type="hidden" name="region_id" value="{{ $regionId }}">
  @endif

  {{-- Country dropdown --}}
  <select name="country_id"
          onchange="this.form.submit()"
          style="
            padding:6px 10px;
            border:1px solid #bbb;
            border-radius:8px;
            min-width:220px;
          ">
    <option value="">Select Countries</option>

    @foreach ($countries as $country)
      <option value="{{ $country->id }}"
        {{ (string)$countryId === (string)$country->id ? 'selected' : '' }}>
        {{ $country->name }}
      </option>
    @endforeach
  </select>

</form>



  {{-- Add button --}}
  <a href="{{ route('admin.cities.create') }}"
     style="padding:6px 10px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
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
          @foreach ($cities as $city)
            <tr>
                {{-- Region name (uses relationship: city -> region) If region is null, display '-' --}}
              <td style="padding:10px; border-bottom:1px solid #eee;">
                {{ $city->region->name ?? '-' }}
              </td>
              {{-- Country name (uses relationship: city -> country) If country is null, display '-' --}}
              <td style="padding:10px; border-bottom:1px solid #eee;">
                {{ $city->country->name ?? '-' }}
              </td>
              {{-- City name (always exists, so no null check) --}}
              <td style="padding:10px; border-bottom:1px solid #eee;">
                {{ $city->name }}
              </td>

              {{-- Action buttons column (Edit / Delete) --}}
              <td style="padding:10px; border-bottom:1px solid #eee; white-space:nowrap;">
                <a href="{{ route('admin.cities.edit', $city) }}"
                   style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; text-decoration:none; margin-right:6px;">
                  Edit
                </a>

                <form method="POST"
                      action="{{ route('admin.cities.destroy', $city) }}"
                      style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          onclick="return confirm('Delete this Location?')"
                          style="padding:4px 8px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </main>
</div>
