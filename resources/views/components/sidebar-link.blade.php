@props(['active', 'collapsed' => false])

@php
$classes = ($active ?? false)
    ? 'flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-vet-primary-500 text-white shadow-md hover:bg-vet-primary-600 transition-all duration-150'
    : 'flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
