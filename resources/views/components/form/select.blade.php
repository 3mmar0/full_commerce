@props(['name', 'options' => [], 'selected' => '', 'label' => '', 'head_option' => ''])

<div class="form-group ">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" class="form-control form select">
        @if ($head_option)
            <option value="">{{ $head_option }}</option>
        @endif
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" @selected(old($name, $selected) == $key)>{{ $value }}</option>
        @endforeach
    </select>
</div>
