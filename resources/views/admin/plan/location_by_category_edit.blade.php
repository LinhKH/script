@if (!empty($locations))
    @foreach ($locations as $types)
        @if ($plan->location == $types->id)
            <option value="{{ $types->id }}" selected>{{ $types->location }}</option>
        @else
            <option value="{{ $types->id }}">{{ $types->location }}</option>
        @endif
    @endforeach
@endif
