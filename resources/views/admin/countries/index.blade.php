<h1>Countries</h1>

<ul>
  @foreach ($countries as $country)
    <li>
      {{ $country->name }} ({{ $country->code }})

      {{-- Delete --}}
      <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
      </form>
    </li>
  @endforeach
</ul>
