@php
    if (!isset($type)) {
        $type = 'text';
    }
@endphp

<div class="form-group">
    @if ($type != 'file')
    <label for="{{ Str::slug($name) }}">{{ $label }}</label>
    @endif
    
    @if ($type == 'textarea')
    <textarea
    {{ $attributes->class(['form-control'])->merge([
        'id' => Str::slug($name),
        'name' => $name,
        'rows' => $rows ?? 4,
    ]) }}>{{ old($name) ?? $value }}</textarea>

    @elseif($type == 'select')
    <select {{ $attributes->merge([
        'class' => 'custom-select text-capitalize', 
        'name' => $name,
        'id' => $id ?? Str::slug($name)
    ]) }}>
        {{ $slot }}
    </select>
    @elseif($type == 'file')
    <div class="custom-file">
        <input {{ $attributes->merge([
            'class' => 'custom-file-input',
            'type' => 'file',
            'id' => $id ?? Str::slug($name),
            'name' => $name
        ]) }} {{ $isRequired == true ? 'required' : '' }}>
        <label class="custom-file-label" for="{{ $id ?? Str::slug($name) }}">
            {{ $label }}
        </label>
    </div>
    @else
    <input {{ $attributes->class(['form-control'])->merge([
        'id' => Str::slug($name),
        'name' => $name,
        'type' => $type ? $type : 'text',
        'value' => isset($value) ? (old($name) ?? $value) : old($name)
    ]) }}>
    @endif
    
    @error($name)
        <div class="text-danger py-2">{{ $message }}</div>
    @enderror

</div>