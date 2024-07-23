@props([
    'title',
    'icon',
    'color',
    'value',
    'link',
])
@php
$title=(isset($title)) ? $title : 'title';
$icon=(isset($icon)) ? $icon : 'bi bi-gear-fill';
$color=(isset($color)) ? $color : 'primary';
$value=(isset($value)) ? $value : '0';
@endphp
@if(!isset($link))
<div class="info-box shadow-sm"> 
    <span class="info-box-icon text-bg-{{ $color }} shadow-sm"> 
        <i class="{{ $icon }}"></i> 
    </span>
    <div class="info-box-content"> 
        <span class="info-box-text">{{ $title }}</span> 
        <span class="info-box-number">
            {{ $value }}
        </span> 
    </div>
</div>
@endif
@if(isset($link))
<div class="small-box text-bg-{{ $color }} shadow-sm">
    <div class="inner">
        <h3>{{ $value }}</h3>
        <p>{{ $title }}</p>
    </div> 
    <div class="small-box-icon" style="position: absolute; top: 0px;">
        <i class="{{ $icon }}"></i>
    </div>
    <a href="{{ $link }}" wire:navigate class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        More info <i class="bi bi-link-45deg"></i> </a>
</div>
@endif