@props(['isActive', 'href', 'text'])

<li>
    <a class="nav-link scrollto {{ $isActive ? 'active' : '' }}" href="{{ $href }}">
        {{ $text }}
    </a>
</li>