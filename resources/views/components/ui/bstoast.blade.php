@props([
    'type',
    'message'
])

@php
$type=isset($type)?$type:'none';
$time=3000;
@endphp

@script
<script data-navigate-once>
    Livewire.on('bstoast',() => {
        var element = document.getElementById('{{ $type }}');
        var toast = new bootstrap.Toast(element);
        toast.show();
    });
</script>
@endscript

@if($type == 'status')
<div id="{{ $type }}" class="toast" role="alert" data-bs-delay="{{ $time }}" aria-live="assertive" aria-atomic="true" wire:ignore.self>
    <div class="toast-header">
    <i class="bi bi-circle me-2"></i>
    <strong class="me-auto">PESAN</strong>
    <small>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    {{ isset($message)?$message:'' }}
    </div>
</div>
@endif

@if($type == 'success')
<div id="{{ $type }}" class="toast" role="alert" data-bs-delay="{{ $time }}" aria-live="assertive" aria-atomic="true" wire:ignore.self>
    <div class="toast-header toast-success">
    <i class="bi bi-check-circle me-2"></i>
    <strong class="me-auto">PESAN</strong>
    <small>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    {{ isset($message)?$message:'' }}
    </div>
</div>
@endif

@if($type == 'warning')
<div id="{{ $type }}" class="toast" role="alert" data-bs-delay="{{ $time }}" aria-live="assertive" aria-atomic="true" wire:ignore.self>
    <div class="toast-header toast-warning me-2">
    <i class="bi bi-exclamation-circle me-2"></i>
    <strong class="me-auto">PESAN</strong>
    <small>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    {{ isset($message)?$message:'' }}
    </div>
</div>
@endif

@if($type == 'danger')
<div id="{{ $type }}" class="toast" role="alert" data-bs-delay="{{ $time }}" aria-live="assertive" aria-atomic="true" wire:ignore.self>
    <div class="toast-header toast-danger">
    <i class="bi bi-x-circle me-2"></i>
    <strong class="me-auto">PESAN</strong>
    <small>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    {{ isset($message)?$message:'' }}
    </div>
</div>
@endif
