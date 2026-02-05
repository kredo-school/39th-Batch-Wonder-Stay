@extends('layouts.admin')

@section('title', 'Admin | Cities')

@section('content')
    <h1 style="margin:0 0 16px 0;">Add City</h1>

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

        <form method="POST" action="{{ route('admin.cities.store') }}">
            @csrf

            {{-- Region --}}
            <div style="margin-bottom:14px;">
                <label style="display:block; margin-bottom:6px; font-weight:600;">
                    Region
                </label>
                <select name="region_id" id="region-select"
                    style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
                    <option value="">-- Select Region --</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
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
                <select name="country_id" id="country-select"
                    style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
                    <option value="">-- Select Country --</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
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
                <input type="text" name="name" value="{{ old('name') }}" placeholder="City name"
                    style="width:100%; padding:8px; border:1px solid #bbb; border-radius:8px;">
            </div>

            {{-- Buttons --}}
            <div style="display:flex; justify-content:flex-end; gap:14px; margin-top:18px;">
                <a href="{{ route('admin.cities.index') }}"
                    style="
       padding:10px 22px;
       border:1px solid #bbb;
       border-radius:10px;
       background:#fff;
       color:#111;
       text-decoration:none;
       font-size:16px;
       line-height:1;
       box-shadow:0 1px 0 rgba(0,0,0,.08);
     ">
                    Cancel
                </a>

                <button type="submit"
                    style="
            padding:10px 22px;
            border:1px solid #444;
            border-radius:10px;
            background:#4b4f57;
            color:#fff;
            font-size:16px;
            line-height:1;
            cursor:pointer;
            box-shadow:0 1px 0 rgba(0,0,0,.15);
          ">
                    Save
                </button>
            </div>


            {{-- Region -> Country filtering --}}
            <script>
                const countries = @json($countries);

                const regionSelect = document.getElementById('region-select');
                const countrySelect = document.getElementById('country-select');

                function resetCountries(selectedRegionId, selectedCountryId = null) {
                    countrySelect.innerHTML = '<option value="">-- Select Country --</option>';

                    if (!selectedRegionId) return;

                    countries.forEach(country => {
                        if (String(country.region_id) === String(selectedRegionId)) {
                            const opt = document.createElement('option');
                            opt.value = country.id;
                            opt.textContent = country.name;

                            if (selectedCountryId && String(selectedCountryId) === String(country.id)) {
                                opt.selected = true;
                            }

                            countrySelect.appendChild(opt);
                        }
                    });
                }

                // region change
                regionSelect.addEventListener('change', () => {
                    resetCountries(regionSelect.value);
                });

                // initial load (if region already selected)
                resetCountries(regionSelect.value, "{{ old('country_id') }}");
            </script>

        @endsection
