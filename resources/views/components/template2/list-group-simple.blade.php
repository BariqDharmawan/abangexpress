<li {{ $attributes }}>
    @isset ($icon)
    <i class="bi {{ $icon }}"></i>
    @endisset
    <h4 class="list-group-simple__text">{{ $text . ': ' }}</h4>
    <p class="list-group-simple__subtext">
        @if($link || '')
        <a href="{{ $link }}" target="__blank">{{ $subtext }}</a>
        @endif
    </p>
</li>
