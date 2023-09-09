@props([
    'type' => 'text',
    'name',
    'value' => '',
    'label' => '',
])

<div class="form-group ">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" @class(['form-control', 'is-invalid' => $errors->has($name)])>{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
