@props(['active' => false, 'title' => 'Dropdown', 'icon' => 'grid-fill'])

<li class="sidebar-item has-sub {{ $active ? 'active' : '' }}">
    <a href="#" class='sidebar-link' onclick="event.preventDefault()">
        <i class="bi bi-{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>

    <ul class="submenu {{ $active ? 'active submenu-open' : '' }}" 
        style="{{ $active ? 'display: block;' : '' }}">
        {{ $slot }}
    </ul>
</li>
