@props(['href' => 'javascript:void(0);', 'text', 'icon' => null])

<li class="nav-item @if($href == url()->current()) active @endif">
    <a {{ $attributes->class([
        'nav-link', 
    ])->merge(['href' => $href]) }}>
        @isset($icon)
        <i class="fas {{ $icon }}"></i>
        @endisset
        <span>{{ $text }}</span>
    </a>
    {{ $slot }}
</li>