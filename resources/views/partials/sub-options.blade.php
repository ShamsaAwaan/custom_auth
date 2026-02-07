<option value="">-- Select Sub Category --</option>

@foreach($subs as $sub)
    <option value="{{ $sub->id }}">
        {{ $sub->name }}
    </option>
@endforeach
