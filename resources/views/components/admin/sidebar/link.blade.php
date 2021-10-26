@props(['href', 'text'])

<a {{ $attributes->class([
    'collapse-item', 
    'active' => $href == url()->current()
])->merge(['href' => $href])}}>
    {{ $text }}
</a>