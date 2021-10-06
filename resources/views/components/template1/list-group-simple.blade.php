<div {{ $attributes->merge(['class' => '']) }}>
    <i class="bi {{ $icon }}"></i>
    <h3>{{ $text }}</h3>
    <a href="{{ $link }}" class="@isset($subtextClass){{ $subtextClass }}@endisset">{{ $subtext }}</a>
</div>