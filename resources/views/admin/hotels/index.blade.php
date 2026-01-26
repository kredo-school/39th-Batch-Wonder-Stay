<h1>Hotels</h1>

<form method="GET" action="{{ route('admin.hotels.index') }}">
  {{-- Region filter --}}
  <select name="region_id">
    <option value="">All regions</option>
    @foreach ($regions as $r)
      <option value="{{ $r->id }}" @selected((string)$r->id === (string)$regionId)>
        {{ $r->name }}
      </option>
    @endforeach
  </select>
  
  {{-- Country filter --}}
  <select name="country_id">
    <option value="">All countries</option>
    @foreach ($countries as $c)
      <option value="{{ $c->id }}" @selected((string)$c->id === (string)$countryId)>
        {{ $c->name }}
      </option>
    @endforeach
  </select>

  {{-- Search --}}
  <input type="text" name="search" value="{{ $search }}" placeholder="Search hotel name">

  <button type="submit">Apply</button>
</form>

<hr>

<table border="1" cellpadding="6">
  <thead>
    <tr>
      <th>Name</th>
      <th>Region</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($hotels as $hotel)
      <tr>
        <td>{{ $hotel->name }}</td>
        <td>{{ $hotel->region->name ?? '-' }}</td>
        <td>
          <a href="{{ route('admin.hotels.edit', $hotel) }}">Edit</a>

          <form method="POST" action="{{ route('admin.hotels.destroy', $hotel) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this hotel?')">Delete</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="3">No hotels found.</td>
      </tr>
    @endforelse
  </tbody>
</table>
