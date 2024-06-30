<x-app-layout>
    <x-slot name="header">
            {{ __('Dashboard') }}
    </x-slot>
    <div>
        <div class="row">
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Dashboard</h3>
                    <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
                </div>
                <div class="card-body">
                    <x-forms.input name="nama" type="text" icon="bi bi-person" label="Nama"  placeholder="Nama" />
                    <x-forms.check name="check" type="radio" collabel='true' radiogroup='true' label="cek 1" value="cek1"  />
                    <x-forms.check name="check" type="radio" collabel='true' radiogroup='true' label="cek 2" value="cek2"  />
                </div> <!-- /.card-body -->
                <div class="card-footer">Footer</div> <!-- /.card-footer-->
            </div> <!-- /.card -->
        </div>
    </div>
</x-app-layout>
