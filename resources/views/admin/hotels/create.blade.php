<h1 style="margin:0 0 16px 0;">Add Hotel</h1>

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

  {{-- Error messages --}}
  @if ($errors->any())
    <ul style="margin-bottom:12px; color:#b00020;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form method="POST" action="{{ route('admin.hotels.store') }}">
    @csrf

    {{-- Country --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Country
      </label>
      <select name="country_id"
              style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
        <option value="">-- Select Country --</option>
        @foreach ($countries as $country)
          <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
            {{ $country->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- ✅ City (optional) --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        City <span style="font-weight:400; color:#666;">(optional)</span>
      </label>

      <select name="city_id"
              style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
        <option value="">-- Select City --</option>
        @foreach ($cities as $city)
          <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
            {{ $city->name }} ({{ $city->country?->name ?? '-' }})
          </option>
        @endforeach
      </select>

      <div style="font-size:12px; color:#666; margin-top:6px;">
        Leave blank if unknown. You can set it later.
      </div>
    </div>

    {{-- Hotel name --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Hotel Name
      </label>
      <input type="text"
             name="name"
             value="{{ old('name') }}"
             placeholder="Hotel name"
             style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
    </div>

    {{-- Description --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Description
      </label>
      <textarea name="description"
                style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;"
                rows="4">{{ old('description') }}</textarea>
    </div>

    {{-- Address --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Address
      </label>
      <input type="text"
             name="address"
             value="{{ old('address') }}"
             placeholder="Address"
             style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
    </div>

    {{-- Phone --}}
    <div style="margin-bottom:14px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Phone
      </label>
      <input type="text"
             name="phone"
             value="{{ old('phone') }}"
             placeholder="Phone"
             style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
    </div>

    {{-- Email --}}
    <div style="margin-bottom:16px;">
      <label style="display:block; margin-bottom:6px; font-weight:600;">
        Email
      </label>
      <input type="email"
             name="email"
             value="{{ old('email') }}"
             placeholder="Email"
             style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
    </div>

    {{-- Buttons --}}
    <div style="display:flex; gap:10px;">
      <button type="submit"
              style="padding:8px 12px; border:1px solid #bbb; border-radius:8px; background:#fff; cursor:pointer;">
        Save
      </button>

      <a href="{{ route('admin.hotels.index') }}"
         style="padding:8px 12px; border:1px solid #bbb; border-radius:8px; text-decoration:none;">
        Cancel
      </a>
    </div>

  </form>
</div>
