@props(['active' => false, 'route' => '#'])

<li class="submenu-item {{ $active ? 'active' : '' }}">
    <a href="{{ route($route) }}" class="submenu-link">{{ $slot }}</a>
</li>
