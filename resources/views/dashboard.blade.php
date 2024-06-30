<x-app-layout>
    @push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @endpush
    @push('js')
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    document.addEventListener("livewire:navigated", () => {
        $('#iniselect').select2({
            theme: 'bootstrap-5',
            selectionCssClass: 'form-select',
        }); 
    });
    </script>
    @endpush
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
                    <x-forms.check name="check" type="radio" id="1" collabel='true' group='true' label="cek 1" value="cek1"  />
                    <x-forms.check name="check" type="radio" id="2" collabel='true' group='true' label="cek 2" value="cek2"  />
                    <x-forms.check name="check" label="cek 1" id="3" group='true' value="cek1"  />
                    <x-forms.check name="check" label="cek 1" id="4" group='true' value="cek1"  />
                    @php
                    $data=collect([
                        ['label'=>'satu','nilai'=>'1'],
                        ['label'=>'dua','nilai'=>'2'],
                        ['label'=>'tiga','nilai'=>'3'],
                    ]);
                    @endphp
                    <x-forms.select label="Ini Select" id="iniselect" name="iniselect" :data="$data"  value="nilai" txtvalue="label" placeholder="Ini Select" />
                </div> <!-- /.card-body -->
                <div class="card-footer">Footer</div> <!-- /.card-footer-->
            </div> <!-- /.card -->
        </div>
    </div>
</x-app-layout>
