@props([
    'route' => 'root',
])

<li><a href="{{ route($route) }}">{{ $slot }}</a></li>
