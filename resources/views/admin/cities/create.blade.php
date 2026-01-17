<h1>Add City</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


<form method="POST" action="{{ route('admin.cities.store') }}">
    @csrf

    <div>
        <label>Region</label>
        <select name="region_id">
            <option value="">-- Select Region --</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="margin-top:12px;">
        <label>Country</label>
        <select name="country_id">
            <option value="">-- Select Country --</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="margin-top:12px;">
        <label>City</label>
        <input type="text" name="name" placeholder="City name">
    </div>

    <div class="margin-top:12px;">
        <button type="submit">Save</button>
    </div>
</form>
