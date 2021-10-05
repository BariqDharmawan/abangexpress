@props(['href' => 'javascript:void(0);', 'text', 'icon' => null])

<li class="nav-item">
    <a {{ $attributes->merge([
        'class' => 'nav-link', 'href' => $href
    ]) }}>
        @isset($icon)
        <i class="fas {{ $icon }}"></i>
        @endisset
        <span>{{ $text }}</span>
    </a>
    {{ $slot }}
</li>