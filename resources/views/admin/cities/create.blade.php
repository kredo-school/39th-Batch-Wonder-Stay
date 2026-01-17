<h1>Add City</h1>

{{-- Show success message --}}
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

{{-- Show error messages --}}
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{{-- City form --}}
<form method="POST" action="{{ route('admin.cities.store') }}">
    @csrf

    {{-- Region select --}}
    <div>
        <label>Region</label>
        <select name="region_id">
            <option value="">-- Select Region --</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Country select --}}
    <div class="mt-12">
        <label>Country</label>
        <select name="country_id">
            <option value="">-- Select Country --</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- City name input --}}
    <div class="mt-12">
        <label>City</label>
        <input type="text" name="name" placeholder="City name">
    </div>

    {{-- Submit button --}}
    <div class="mt-12">
        <button type="submit">Save</button>
    </div>
</form>
