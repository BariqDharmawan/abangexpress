@props(['id', 'parent'])

<div {{ $attributes->merge([
    'class' => 'collapse',
    'id' => $id,
    'data-parent' => '#' . $parent
]) }}>
    <div class="bg-white py-2 collapse-inner rounded">
        {{ $slot }}
    </div>
</div>