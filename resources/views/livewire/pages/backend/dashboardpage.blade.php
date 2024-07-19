@script 
<script>
    document.addEventListener('livewire:navigated', function () {
        Livewire.on('tesmodal', function () {
            $('#mymodal').modal('show');
        });
    });
</script>
@endscript
<x-slot name="header">
    Dashboard
</x-slot>
<div>
    <div class="row">
        <div class="col-12">

        <x-ui.modal id="mymodal" btncolor="danger" submit="deleteUser" textsubmit="Delete Account" title="Delete Account">
                test modal
        </x-ui.modal>

        <x-ui.card title="Dashboard" class="card-primary card-outline" cancel="" submit="save">
            {{ print_r($inidatatable) }}
            <x-ui.datatables id="mytable" title="Ini Datatable" model="inidatatable" :selectvalue="$inidatatable" :tdata="$user" :thead="['Nama','Email']" :tbody="['name','email']" :tbtn="['edit','delete']" :headbtn="['pdf','delete']"/>
            <x-forms.input name="initext" type="text" id="nama" icon="bi bi-person" label="Nama"  placeholder="Nama" />
            <x-forms.input name="inifile" type="file" id="inifile" label="Upload"  placeholder="inifile" />
            <x-forms.check name="iniradio" type="radio" id="1" group='true' label="radio1" value="radio1"  />
            <x-forms.check name="iniradio" type="radio" id="2" group='true' label="radio2" value="radio2"  />
            <x-forms.check name="inicheck" label="cek 1" id="3" value="check1" />
            <x-forms.select select2="true" label="Ini Select" id="iniselect"  name="iniselect" :data="$roles"  value="name" txtvalue="name" placeholder="Pilih Role" />
        </x-ui.card>
        </div>
    </div>
</div>