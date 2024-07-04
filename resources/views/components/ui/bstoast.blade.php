@script
<script data-navigate-once>
    const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')


if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show()
  })
}

Livewire.on('runbstoast', () => {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastBootstrap.show();
});
</script>
@endscript
<div class="row">
    <div class="col">
        <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>
        <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header toast-primary">
            <i class="bi bi-circle me-2"></i>
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            Hello, world! This is a toast message.
            </div>
        </div>
        </div>
    </div>
</div>