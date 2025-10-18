@props(['type' => 'button', 'variant' => 'primary'])

@php
    $baseClasses = 'px-4 py-2 rounded-lg font-medium text-sm focus:outline-none transition-colors';
    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
    ];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary'])]) }}>
    {{ $slot }}
</button>
