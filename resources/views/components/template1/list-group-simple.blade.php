<div {{ $attributes->merge(['class' => '']) }}>
    <i class="bi {{ $icon }}"></i>
    <h3>{{ $text }}</h3>
    <a href="{{ $link }}" class="contact-value">{{ $subtext }}</a>
</div>