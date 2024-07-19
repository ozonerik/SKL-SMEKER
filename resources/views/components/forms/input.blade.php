
@props([
    'name',
    'label',
    'value',
    'icon',
    'type',
    'id',
    'icontext',
    'iconposition' => 'right',
    'collabel' => false,
])
@php
$value=(isset($value)) ? $value : '';
$icon=(isset($icon)) ? $icon : null;
$id=(isset($id)) ? $id : $name;
$type=(isset($type)) ? $type : 'text';
$icontext=(isset($icontext)) ? $icontext : null;
$isinvalid=($errors->has($name)) ? 'is-invalid' : '';
@endphp

<div class="mb-3 mt-1 {{ ($collabel)?'row':'' }}"

@if($type == 'file')
    x-data="{ uploading: false, progress: 0 }"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-cancel="uploading = false"
    x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
@endif

>
    @if(isset($label))
    <label for="{{ $id }}" class="{{ ($collabel)?'col-sm-2 col-form-label':'form-label' }}">{{ $label }}</label>
    @endif
    @if($collabel)
    <div class="col-sm-10">
    @endif
    <div class="input-group @error($name) has-validation @enderror"> 
        @if (isset($icon) && $iconposition == 'left' && $type != 'file')
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

        @if($type=='file')
        wire:loading.attr="disabled"
        wire:target="{{ $name }}"
        @endif

        name="{{ $name }}"
        id="{{ $id }}" 
        {{ $attributes->merge([
            'type' => $type,
            'placeholder' => '',
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
                @if ($type != 'file')
                    {{ $icontext }}
                @else
                    Upload
                @endif
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
    @if($type=='file')
    <div class="progress mt-2" role="progressbar" x-show="uploading">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"  :style="'width: ' + progress + '%; border-radius: 0.375rem; '" ></div>
    </div>
    @endif
</div>