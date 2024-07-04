@props([
    'id',
    'message'
])

@php
$id=isset($id)?$id:'1';
@endphp

@script
<script data-navigate-once>
    Livewire.on('bstoast',() => {
        var element = document.getElementById('{{ $id }}');
        var toast = new bootstrap.Toast(element);
        toast.show();
    });
</script>
@endscript

<div id="{{ $id }}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header toast-primary">
    <i class="bi bi-circle me-2"></i>
    <strong class="me-auto">PESAN</strong>
    <small>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    {{ isset($message)?$message:'' }}
    </div>
</div>
