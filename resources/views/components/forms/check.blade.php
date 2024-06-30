
@props([
    'label',
    'title',
    'name',
    'value',
    'id',
    'type',
    'radiogroup' => false,
    'data',
    'collabel' => false,
])
@php
$value=(isset($value)) ? $value : $name;
$id=(isset($id)) ? $id : $name;
$type=(isset($type)) ? $type : 'checkbox';
$title=(isset($title)) ? $title : '';
$isinvalid=($errors->has($name)) ? 'is-invalid' : '';
@endphp

<div class="{{ ($collabel)?'row':'' }} {{ ($radiogroup)?'':'mb-3 mt-1' }}">
    @if($collabel)
    <div class="col-sm-2">
        {{ $title }}
    </div>
    <div class="col-sm-10">
    @else
        <div class="form-check-label mb-1">{{ $title }}</div>
    @endif
        <div class="form-check @error($name) has-validation @enderror"> 
            <input  
            name="{{ $name }}" 
            id="{{ $id }}" 
            value="{{ $value }}"
            {{ $attributes->merge(['type' => $type,'required' => '',]) }}
            {{ $attributes->merge([ 'class' => 'form-check-input '.$isinvalid ]) }}
            > 
            <label class="form-check-label" for="{{ $id }}">
                {{ $label }}
            </label>
            @error($name)
            <div class="invalid-feedback">
            sdasd
            </div>
            @enderror
        </div>
    @if($collabel)
    </div>
    @endif
</div>