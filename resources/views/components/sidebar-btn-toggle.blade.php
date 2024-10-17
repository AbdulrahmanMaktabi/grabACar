<li class="menu-item {{ $active }}">
    <a href="index.html" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx {{ $icon }}"></i>
        <div data-i18n="Analytics">{{ $title }} Settings</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-itme">
            <a href="{{ $indexRoute }}" class="menu-link">{{ $title }}</a>
        </li>
        <li class="menu-itme">
            <a href="{{ $createRoute }}" class="menu-link">Create A {{ substr($title, 0, -1) }}</a>
        </li>
    </ul>
</li>
