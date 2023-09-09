@props(['options', 'name', 'checked' => false])

@foreach ($options as $value => $text)
    <div class="form-check">
        <input type="radio" id="{{ $value }}" value="{{ $value }}" name="{{ $name }}"
            class="form-check-input" @checked(old($name, $checked) == $value) {{ $attributes }}>
        <label for="{{ $value }}" class="form-check-label">{{ $text }}</label>
    </div>
@endforeach
