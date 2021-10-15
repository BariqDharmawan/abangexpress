@props(['modalTarget', 'isDefaultStyle' => true, 'text'])

<button {{ $attributes->class(['btn', 'btn-primary' => $isDefaultStyle])->merge([
    'data-target' => '#' . $modalTarget,
    'type' => 'button',
    'data-toggle' => 'modal'
]) }}>
    {{ $text }}
</button>