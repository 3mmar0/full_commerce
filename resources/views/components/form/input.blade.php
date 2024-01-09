@props([
    'type' => 'text',
    'name' => '',
    'value' => '',
    'label' => '',
])

<div class="form-group ">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" value="{{ old($name, $value) }}" name="{{ $name }}" id="{{ $name }}"
        {{ $attributes }} @class(['form-control', 'is-invalid' => $errors->has($name)]) />

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
