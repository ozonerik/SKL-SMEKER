
@props([
    'name',
    'label',
    'icon',
    'icontext',
    'iconposition' => 'right',
    'collabel' => false,
])
@php
$icon=(isset($icon)) ? $icon : null;
$icontext=(isset($icontext)) ? $icontext : null;
$isinvalid=($errors->has($name)) ? 'is-invalid' : '';
@endphp
<div class="mb-3 mt-1 {{ ($collabel)?'row':'' }}">
    @if(isset($label))
    <label for="{{ $name }}" class="{{ ($collabel)?'col-sm-2 col-form-label':'form-label' }}">{{ $label }}</label>
    @endif
    @if($collabel)
    <div class="col-sm-10">
    @endif
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
            ]) 
        }}
        {{ $attributes->merge([
            'class' => 'form-control '.$isinvalid
            ])
        }}
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
    @if($collabel)
    </div>
    @endif
</div>