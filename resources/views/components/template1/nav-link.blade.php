@props(['href', 'text'])

<li>
    <a {{ $attributes->merge(['href' => $href]) }}>
        {{ $text }}
    </a>
</li>