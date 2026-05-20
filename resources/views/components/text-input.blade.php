@props(['type' => 'text', 'name', 'value', 'placeholder', 'required' => false, 'autofocus' => false, 'autocomplete'])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
    @if($autofocus) autofocus @endif
    @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    {{ $attributes->merge(['class' => 'block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) }}
/>