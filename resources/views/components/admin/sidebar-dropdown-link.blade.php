@props(['href', 'text'])

<a {{ $attributes->merge([
    'class' => 'collapse-item', 'href' => $href
]) }}>
    {{ $text }}
</a>