@props([
    'title',
    'submit',
    'btncolor',
    'cancel',
    'textsubmit',
    'textcancel',
    'modaltarget',
    'textbutton',
])
@php
$title=(isset($title)) ? $title : '';
$btncolor=(isset($btncolor)) ? $btncolor : 'primary';
$textsubmit=(isset($textsubmit)) ? $textsubmit : 'Submit';
$textcancel=(isset($textcancel)) ? $textcancel : 'Cancel';
$textbutton=(isset($textbutton)) ? $textbutton : 'Submit';
@endphp
<div {{ $attributes->merge(['class' => 'card mb-5 '])}} >
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-tools"> 
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> 
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i> 
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> 
            </button> 
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> 
                <i class="bi bi-x-lg"></i> 
            </button> 
        </div>
    </div>
    @if(isset($submit))
    <form wire:submit="{{ $submit }}">
    @endif
        <div class="card-body">
            {{ $slot }}
        </div>

    @if(isset($modaltarget))
        <div class="card-footer">
            <button type="button" class="btn btn-{{ $btncolor }}" data-bs-toggle="modal" data-bs-target="#{{ $modaltarget }}">
                {{ $textbutton }}
            </button>
            @if(isset($cancel))
                    <button type="button" wire:click="{{ $cancel }}" class="btn float-end">{{ $textcancel }}</button>
            @endif
        </div>
    @endif

    @if(isset($submit))
        <div class="card-footer">
                <button type="submit" class="btn btn-{{ $btncolor }}">{{ $textsubmit }}</button>
            @if(isset($cancel))
                <button type="button" wire:click="{{ $cancel }}" class="btn float-end">{{ $textcancel }}</button>
            @endif
        </div>
    </form>
    @endif
</div>