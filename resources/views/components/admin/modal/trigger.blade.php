@props(['modalTarget', 'isDefaultStyle' => true, 'text'])

<button {{ $attributes->class(['btn', 'text-white', 'bg-red' => $isDefaultStyle])->merge([
    'data-target' => '#' . $modalTarget,
    'type' => 'button',
    'data-toggle' => 'modal'
]) }}>
    {{ $text }}
</button>
