@php
    if (!isset($type)) {
        $type = 'text';
    }
@endphp

<div class="form-group">
    <label for="{{ Str::slug($name) }}">{{ $label }}</label>
    
    @if ($type == 'textarea')
    <textarea
    {{ $attributes->class(['form-control'])->merge([
        'id' => Str::slug($name),
        'name' => $name,
        'rows' => $rows ?? 4,
    ]) }}>{{ old($name) ?? $value }}</textarea>

    @else
    <input {{ $attributes->class(['form-control'])->merge([
        'id' => Str::slug($name),
        'name' => $name,
        'type' => $type ? $type : 'text',
        'value' => old($name) ? old($name) : $value
    ]) }}>
    @endif
    
    @error($name)
        <div class="text-danger py-2">{{ $message }}</div>
    @enderror
    
</div>