@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
<x-slot name="header">
    Dashboard
</x-slot>
<div>
    <div class="row">
        <div class="col-12"> <!-- Default box -->
        <x-ui.card title="Dashboard" class="card-primary card-outline" cancel="" submit="save">
            <x-forms.input name="initext" type="text" id="nama" icon="bi bi-person" label="Nama"  placeholder="Nama" />
            <x-forms.check name="iniradio" type="radio" id="1" group='true' label="radio1" value="radio1"  />
            <x-forms.check name="iniradio" type="radio" id="2" group='true' label="radio2" value="radio2"  />
            <x-forms.check name="inicheck" label="cek 1" id="3" value="check1" />
            <x-forms.select select2="true" label="Ini Select" id="iniselect"  name="iniselect" :data="$roles"  value="name" txtvalue="name" placeholder="Pilih Role" />
        </x-ui.card>
        </div>
    </div>
</div>