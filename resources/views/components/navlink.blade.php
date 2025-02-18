@props(['active' => false ])

<a {{ $attributes }} class="{{ $active ? 'text-blue-600 font-bold' : 'text-md text-gray-400 hover:text-blue-600' }}"
aria-current="{{ $active ? 'page' : false }}">{{ $slot }}</a>