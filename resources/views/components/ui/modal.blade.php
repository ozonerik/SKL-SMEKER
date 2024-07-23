@props([
    'title',
    'id',
    'submit',
    'btncolor',
    'cancel',
    'textsubmit',
    'textcancel',
])
@php
$title=(isset($title)) ? $title : '';
$id=(isset($id)) ? $id : '';
$idlabel=(isset($id)) ? $id.'label' : 'label';
$btncolor=(isset($btncolor)) ? $btncolor : 'primary';
$textsubmit=(isset($textsubmit)) ? $textsubmit : 'Submit';
$textcancel=(isset($textcancel)) ? $textcancel : 'Cancel';
@endphp
<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $idlabel }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="{{ $idlabel }}">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if(isset($submit))
            <form wire:submit="{{ $submit }}">
            @endif
                <div class="modal-body">
                    {{ $slot }}
                </div>
            @if(isset($submit))
                <div class="modal-footer">
                    <div class="col float-start">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-{{ $btncolor }} ">{{ $textsubmit }}</button>
                    </div>
                    <div clas="col float-end">
                    @if(isset($cancel))
                        <button type="button" wire:click="{{ $cancel }}" data-bs-dismiss="modal" class="btn float-end">{{ $textcancel }}</button>
                    @else
                        <button type="button" data-bs-dismiss="modal" class="btn">Cancel</button>
                    @endif
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>