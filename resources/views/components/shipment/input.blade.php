@props([
    'type' => 'text',
    'name',
    'placeholder' => null,
    'rows' => 4,
    'id' => null,
    'smallText' => null,
    'iconAddon' => null,
    'textAddon' => null,
    'required' => null,
    'label' => null,
    'inputHidden' => null
])


<div class="form-group form-float form-group-lg">
    @if ($type == 'select' or $type == 'select-ajax')
        <label for="{{ $id }}" class="form-label
        @isset($required)form-label--required @endisset">
            {{ $label ?? $placeholder }}
        </label>
        <select {{ $attributes->class([
            'select2' => $type == 'select',
            'select2-ajax' => $type == 'select-ajax'
        ])->merge([
            'name' => $name,
            'id' => $id
        ]) }} style="width: 100%" required>
            <option selected disabled>{{ $placeholder ?? "Pilih $label" }}</option>
            {{ $slot }}
        </select>
    @elseif($type == 'file')
    <div class="custom-file">
        <input {{ $attributes->class(['custom-file__input'])->merge([
            'name' => $name,
            'type' => 'file',
            'id' => $id,
            'required' => $required,
            'value' => old($name),
            'data-input-hidden' => $inputHidden
            ]) }} />
        <label for="{{ $id }}" class="custom-file__label">
            <span>{{ $placeholder }}</span>
        </label>
    </div>
    @else
        @if (isset($iconAddon) || isset($textAddon))
        <label class="form-label z-20 mb-0" for="{{ $id }}">
            {{ $label ?? $placeholder }}
        </label>
        <div class="input-group mb-0">
            <span class="input-group-addon">
                @isset($iconAddon)
                    <i class="material-icons">{{ $iconAddon }}</i>
                @endisset
                @isset($textAddon)
                    {{ $textAddon }}
                @endisset
            </span>
            <div class="form-line">
                <input {{ $attributes->class(['form-control'])->merge([
                    'type' => $type,
                    'id' => $id ?? Str::slug($label),
                    'name' => $name,
                    'required' => $required,
                    'placeholder' => $placeholder,
                    'value' => old($name)
                ]) }}>
            </div>
        </div>
        @else
        <div class="form-line">
            @if ($type == 'textarea')
                <textarea
                {{ $attributes->class(['form-control', 'no-resize'])->merge([
                    'name' => $name,
                    'type' => $type,
                    'rows' => $rows,
                    'id' => $id ?? Str::slug($label),
                    'required' => $required
                ]) }}>{{ old($name) }}</textarea>
                <label class="form-label mb-0" for="{{ $id ?? Str::slug($label) }}">
                    {{ $label ?? $placeholder }}
                </label>
            @else
                <input {{ $attributes->class(['form-control'])->merge([
                    'name' => $name,
                    'type' => $type,
                    'id' => $id ?? Str::slug($label),
                    'required' => $required,
                    'value' => old($name)
                ]) }} />
                <label class="form-label mb-0" for="{{ $id ?? Str::slug($label) }}">
                    {{ $label ?? $placeholder }}
                </label>
            @endif
        </div>
        @endif
    @endif

    @if ($type == 'file' and $inputHidden != null)
        @error($inputHidden)
            <small class="text-danger d-block mt-2">
                {{ $message }}
            </small>
        @else
            @isset($smallText)
            <small class="text-black-50 helper-input" data-default-helper="{{ $smallText }}">{{ $smallText }}</small>
            @else
            <small class="text-danger error-ajax-{{ $inputHidden }}
            d-block mt-2"></small>
            @endisset
        @enderror
    @else
        @error($name)
            <small class="text-danger d-block mt-2">{{ $message }}</small>
        @else
            @isset($smallText)
            <small class="text-black-50 helper-input" data-default-helper="{{ $smallText }}">{{ $smallText }}</small>
            @else
            <small class="text-danger error-ajax-{{ $name }} d-block mt-2"></small>
            @endisset
        @enderror
    @endif
</div>
