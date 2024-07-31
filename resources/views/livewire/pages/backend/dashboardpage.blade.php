<x-slot name="header">
    Dashboard
</x-slot>
<div>
    <div class="row">
        <div class="col-12">

            <x-ui.modal id="upload-user" btncolor="success" submit="ImportUser" textsubmit="Import" title="Import User">
                <x-forms.input name="userfile" type="file" id="userfile" label="Upload User From Excel" />
                <span>silahkan download 
                    <a href="{{ asset('excel_template/adduser.xlsx') }}" class="link-primary link-underline-opacity-0 link-underline-opacity-50-hover">
                template <i class="bi bi-link-45deg"></i> 
            </a> ini untuk import user</span>
            </x-ui.modal>

            <x-ui.card title="Dashboard" class="card-primary card-outline" cancel="" submit="save">
                <x-ui.infobox link="{{ route('home') }} " color="success" icon="bi bi-people-fill" title="jumlah user" value="100"/>
                {{ var_dump($inidatatable) }}
                <x-ui.datatables id="mytable" title="Ini Datatable" model="inidatatable" :selectvalue="$inidatatable" :tdata="$user" :thead="['Nama','Email']" :tbody="['name','email']" :tbtn="['edit','delete']" :headbtn="['import','delete']"/>
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