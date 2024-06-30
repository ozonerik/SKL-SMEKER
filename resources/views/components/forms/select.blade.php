
@props([
    'name',
    'id',
    'data',
    'label',
    'txtvalue',
    'value',
    'collabel' => false,
])
@php
$id=(isset($id)) ? $id : $name;
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
        <select
        wire:model="{{ $name }}" 
        name="{{ $name }}"
        id="{{ $id }}" 
        {{ $attributes->merge([
            'placeholder' => '',
            ]) 
        }}
        {{ $attributes->merge([
            'class' => 'form-select '.$isinvalid
            ])
        }}
        >
        @foreach ($data as $item)
        <option value="{{ $item[$value] }}">{{ $item[$txtvalue] }}</option>
        @endforeach

        </select>

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