
@props([
    'name',
    'label',
    'icon',
    'icontext',
    'iconposition' => 'right',
])
@php
$icon=(isset($icon)) ? $icon : null;
$icontext=(isset($icontext)) ? $icontext : null;
@endphp
<div class="mb-2 mt-1">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <div class="input-group @error($name) has-validation @enderror"> 
        @if (isset($icon) && $iconposition == 'left')
        <span class="input-group-text">
            @if ((isset($icon)||isset($icontext)) && !isset($icontext))
                <span class="{{ $icon }}"></span>
            @endif
            @if (isset($icontext) && !isset($icon))
                {{ $icontext }}
            @endif
        </span>
        @endif
        <input
        wire:model="{{ $name }}" 
        name="{{ $name }}"  
        class="form-control @error($name) is-invalid @enderror" 
        id="{{ $name }}" 
        {{ $attributes->merge([
            'type' => 'text',
            'placeholder' => '',
            'required' => '',
            'autofocus' => '',
            'autocomplete' => 'off',
            ]) }}
        >
        @if (isset($icon) && $iconposition == 'right')
        <span class="input-group-text">
            @if ((isset($icon)||isset($icontext)) && !isset($icontext))
                <span class="{{ $icon }}"></span>
            @endif
            @if (isset($icontext) && !isset($icon))
                {{ $icontext }}
            @endif
        </span>
        @endif
        @error($name)
        <div class="invalid-feedback">
        {{ $message }}
        </div>
        @enderror
    </div>
</div>