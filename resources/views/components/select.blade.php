@props(['disabled' => false, 'values' => [], 'selected' => 1])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    @foreach ($values as $key => $value)
        <option value="{{ $key }}" @if ($key == $selected)
            selected
        @endif>{{ $value }}</option>
    @endforeach
</select>