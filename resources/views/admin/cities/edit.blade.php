<h1>Edit City</h1>

{{-- Show success message --}}
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

{{-- Show validation error messages --}}
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{{-- Edit city form --}}
<form method="POST" action="{{ route('admin.cities.update', $city->id) }}">
    @csrf
    @method('PATCH') 

    {{-- Region select (pre-selected with current city region) --}}
    <div>
        <label>Region</label>
        <select name="region_id">
            <option value="">-- Select Region --</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}"
                    {{ old('region_id', $city->region_id) == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Country select (pre-selected with current city country) --}}
    <div class="mt-12">
        <label>Country</label>
        <select name="country_id">
            <option value="">-- Select Country --</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    {{ old('country_id', $city->country_id) == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- City name input (pre-filled with current city name)--}}
    <div class="mt-12">
        <label>City</label>
        <input type="text" name="name" value="{{ old('name', $city->name) }}">
    </div>

    {{-- Submit button --}}
    <div class="mt-12">
        <button type="submit">Save</button>
    </div>
</form>
