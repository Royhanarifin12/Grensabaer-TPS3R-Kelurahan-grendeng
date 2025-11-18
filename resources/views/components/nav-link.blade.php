@props([
    'route' => '#',
])

<li>
    <a href="{{ route($route) }}" class="{{ Route::is($route) ? 'active' : '' }}">
        {{ $slot }}
    </a>
</li>
