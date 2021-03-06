@php
    if (!isset($type)) {
        $type = 'text';
    }
@endphp

<div class="form-group">
    @if ($type != 'file')
    <label for="{{ $id ?? Str::slug($name) }}">{{ $label }}</label>
    @endif

    @if ($type == 'textarea')
    <textarea
    {{ $attributes->class(['form-control'])->merge([
        'id' => Str::slug($name),
        'name' => $name,
        'rows' => $rows ?? 4,
    ]) }}>{{ old($name) ?? (isset($value) ? $value : '') }}</textarea>

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
        ]) }} {{ $isRequired ? 'required' : '' }}>
        <label class="custom-file-label" for="{{ $id ?? Str::slug($name) }}">
            {{ $label }}
        </label>
    </div>

    @else
        @isset ($textAddon)
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{ $textAddon }}</div>
            </div>
            <input {{ $attributes->class(['form-control'])->merge([
                'id' => Str::slug($name),
                'name' => $name,
                'type' => $type,
                'value' => old($name) ?? (isset($value) ? $value : '')
            ]) }}>
        </div>
        @else
        <input {{ $attributes->class(['form-control'])->merge([
            'id' => Str::slug($name),
            'name' => $name,
            'type' => $type,
            'value' => old($name) ?? (isset($value) ? $value : '')
        ]) }}>
        @endisset
    @endif

    @error($name)
        <div class="text-danger py-2">{{ $message }}</div>
    @else
        @if ($type != 'select')
            {{ $slot }}
        @endif
    @enderror

</div>
