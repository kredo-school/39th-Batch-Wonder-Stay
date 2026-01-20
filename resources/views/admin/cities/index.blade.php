<h1>Cities</h1>

<ul>
    @foreach ($cities as $city)
        <li>
            {{ $city->name }}
            ({{ $city->region->name }} / {{ $city->country->name }})
        </li>
    @endforeach    
</ul>

{{-- Delete button --}}
<form  method="POST" action="{{ route('admin.cities.destroy', $city->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>