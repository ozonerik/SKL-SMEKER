<x-slot name="header">
        {{ __('Admin Page') }}
</x-slot>
<div class="col-12"> <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin Page</h3>
            <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
        </div>
        <div class="card-body">
            {{ __("Admin Page") }}
        </div> <!-- /.card-body -->
        <div class="card-footer">Footer</div> <!-- /.card-footer-->
    </div> <!-- /.card -->
</div>