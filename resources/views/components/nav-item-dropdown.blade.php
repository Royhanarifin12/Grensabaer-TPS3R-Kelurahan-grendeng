@props([
    'title' => 'Dropdown',
    'active' => false,
])

<li class="dropdown">
    <a href="#" class="{{ $active ? 'active' : '' }}"><span>{{ $title }}</span>
        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
    <ul>
        {{ $slot }}
    </ul>
</li>
