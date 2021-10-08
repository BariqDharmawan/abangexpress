@props([
    'href' => 'javascript:void(0);', 'text', 'icon', 'isDropdown' => false,
    'color' => null
])

<li {{ $attributes->merge(['class' => '']) }}>
    <a href="{{ $href  }}" class="@if($isDropdown)menu-toggle @endif
    @isset($color)text-{{ $color }} @endisset">
        @isset($icon)
        <i class="material-icons">{{ $icon }}</i>
        @endisset
        <span class="@isset($color)text-{{ $color }} @endisset">{{ $text }}</span>
    </a>

    @if($isDropdown)
        <ul class="ml-menu">
            {{ $slot }}
        </ul>
    @else
        {{ $slot }}
    @endif

</li>