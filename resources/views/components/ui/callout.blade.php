@props([
    'type',
])
@php
$type=(isset($type)) ? $type : 'info';
@endphp
<div class="row mb-3">
    <div class="col-12">
        <div class="callout callout-{{ $type }}">
           {{ $slot }}
        </div>
    </div> 
</div>