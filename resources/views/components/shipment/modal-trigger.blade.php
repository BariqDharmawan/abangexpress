@props(['target', 'text' => null, 'icon' => null])

<button {{ $attributes->class(['btn', 'waves-effect'])->merge([
    'data-toggle' => 'modal',
    'data-target' => '#' . $target,
    'type' => 'button'
]) }}>
    @isset($icon)
    <i class="material-icons">{{ $icon }}</i>
    @endisset
    @isset($text)
    <span>{{ $text }}</span>
    @endisset
</button>