<option value="" selected disabled>Select Location</option>
@if (!empty($locations))
    @foreach ($locations as $types)
        <option value="{{ $types->id }}">{{ $types->location }}</option>
    @endforeach
@endif
