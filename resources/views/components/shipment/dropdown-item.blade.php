@props(['href' => 'javascript:void(0);', 'text', 'icon', 'isDropdown' => false])

<li {{ $attributes->merge(['class' => '']) }}>
    <a href="{{ $href  }}" @if($isDropdown) class="menu-toggle" @endif>
        @isset($icon)
        <i class="material-icons">{{ $icon }}</i>
        @endisset
        <span>{{ $text }}</span>
    </a>

    @if($isDropdown)
        <ul class="ml-menu">
            {{ $slot }}
        </ul>
    @endif

</li>