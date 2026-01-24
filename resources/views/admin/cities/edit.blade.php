<h1 style="margin:0 0 16px 0;">Edit City</h1>

<div style="
    max-width: 720px;
    border:1px solid #bbb;
    border-radius:10px;
    padding:16px;
  ">

  {{-- Success message --}}
  @if (session('success'))
    <div style="margin-bottom:12px; color:green;">
      {{ session('success') }}
    </div>
  @endif

  {{-- Validation error messages --}}
  @if ($errors->any())
    <ul style="margin-bottom:12px; color:#b00020;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  {{-- Edit city form --}}
  <form method="POST" action="{{ route('admin.cities.update', $city) }}">
    @csrf
    @method('PATCH')

    {{-- Region --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Region
      </label>
      <select name="region_id"
              style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
        <option value="">-- Select Region --</option>
        @foreach ($regions as $region)
          <option value="{{ $region->id }}"
            {{ old('region_id', $city->region_id) == $region->id ? 'selected' : '' }}>
            {{ $region->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Country --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Country
      </label>
      <select name="country_id"
              style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
        <option value="">-- Select Country --</option>
        @foreach ($countries as $country)
          <option value="{{ $country->id }}"
            {{ old('country_id', $city->country_id) == $country->id ? 'selected' : '' }}>
            {{ $country->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- City --}}
    <div style="margin-bottom:16px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        City
      </label>
      <input type="text"
             name="name"
             value="{{ old('name', $city->name) }}"
             style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
    </div>

    {{-- Buttons --}}
    <div style="display:flex; gap:10px;">
      <button type="submit"
              style="padding:8px 12px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
        Update
      </button>

      <a href="{{ route('admin.cities.index') }}"
         style="padding:8px 12px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
        Cancel
      </a>
    </div>

  </form>
</div>
