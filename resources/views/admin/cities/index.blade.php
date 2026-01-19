<h1>Cities</h1>

<ul>
    @foreach ($cities as $city)
        <li>
            {{ $city->name }}
            ({{ $city->region->name }} / {{ $city->country->name }})
        </li>
    @endforeach    
</ul>