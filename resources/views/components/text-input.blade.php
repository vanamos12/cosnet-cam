@props(['disabled' => false])  

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-1 px-2 py-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
