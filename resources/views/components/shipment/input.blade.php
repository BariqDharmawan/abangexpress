@props([
    'type' => 'text',
    'name',
    'placeholder',
    'rows' => 4,
    'id' => null,
    'smallText' => null,
    'iconAddon' => null,
    'textAddon' => null,
    'required' => null,
    'label' => null
])


<div class="form-group form-float form-group-lg">
    @if ($type == 'select')
        <label for="{{ $id }}" class="form-label 
        @isset($required)form-label--required @endisset">
            {{ $placeholder }}
        </label>
        <select {{ $attributes->class(['select2'])->merge([
            'name' => $name,
            'id' => $id,
            'required' => $required
        ]) }} style="width: 100%">
            <option selected disabled>{{ $placeholder }}</option>
            {{ $slot }}
        </select>
    @elseif($type == 'file')
    <div class="custom-file">
        <input {{ $attributes->class(['custom-file__input'])->merge([
            'name' => $name, 
            'type' => 'file',
            'id' => $id,
            'required' => $required,
            'value' => old($name)
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
                    'id' => $id,
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
                    'id' => $id,
                    'required' => $required
                ]) }}>{{ old($name) }}</textarea>
                <label class="form-label mb-0" for="{{ $id }}">{{ $placeholder }}</label>
            @else
                <input {{ $attributes->class(['form-control'])->merge([
                    'name' => $name, 
                    'type' => $type,
                    'id' => $id,
                    'required' => $required,
                    'value' => old($name)
                ]) }} />
                <label class="form-label mb-0" for="{{ $id }}">{{ $placeholder }}</label>
            @endif
        </div>
        @endif
    @endif

    @error($name)
        <small class="text-danger d-block" style="margin-top: 5px">{{ $message }}</small>
    @else
        @isset($smallText)
        <small class="text-black-50">{{ $smallText }}</small>
        @else
        <small class="text-danger error-ajax-{{ $name }} d-block" style="margin-top: 5px"></small>
        @endisset
    @enderror
</div>