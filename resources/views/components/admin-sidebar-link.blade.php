@props([
    'active' => false,
    'route' => '#',
    'icon' => 'grid-fill',
])

@php
    $classes = $active ?? false ? 'sidebar-item active' : 'sidebar-item';
@endphp

<li class="{{ $classes }}">
    <a href="{{ route($route) }}" class='sidebar-link'>
        <i class="bi bi-{{ $icon }}"></i>
        <span>{{ $slot }}</span>
    </a>
</li>
