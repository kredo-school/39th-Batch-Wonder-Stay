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
      <div>North America</div>
      <div>South America</div>
      <div>Europe</div>
      <div>Asia</div>
      <div>Oceania</div>
      <div>Middle East</div>
      <div>Africa</div>
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


    {{-- Actions row --}}
    <div style="display:flex; justify-content:flex-end; margin-bottom:10px;">
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
