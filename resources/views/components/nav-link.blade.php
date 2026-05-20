@props(['href', 'active'])

<a href="{{ $href }}"
   @class([
       'block px-4 py-2 text-sm font-medium rounded-md transition',
       'bg-indigo-50 text-indigo-700' => $active,
       'text-gray-700 hover:bg-gray-100 hover:text-gray-900' => ! $active,
   ])
>
    {{ $slot }}
</a>