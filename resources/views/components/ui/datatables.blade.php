@props([
    'id',
    'tdata',
    'thead',
    'tbody',
    'model',
    'tbtn',
    'headbtn'
])

@php
$id=isset($id)?$id:'sample';
$tdata=isset($tdata)?$tdata:[];
$thead=isset($thead)?$thead:[];
$tbody=isset($tbody)?$tbody:[];
$tbtn=isset($tbtn)?$tbtn:[];
$headbtn=isset($headbtn)?$headbtn:[];
$col=[];
for ($x = 2; $x <= count($thead)+2; $x++) {
    $col[] = $x;
};
@endphp

@assets
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
<!-- checkbox -->
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css" />
<!-- checkbox -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" />
<!-- button -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.css" />

<script data-navigate-once src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<!-- checkbox -->
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>
<!-- responsive -->
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js" ></script>
<!-- button -->
<script data-navigate-once src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.js" ></script>
<!-- extension button 'copy', 'csv', 'excel', 'pdf', 'print' -->
<script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" ></script>
<script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" ></script>
<script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js" ></script>
@endassets
@script
<script data-navigate-once>
document.addEventListener("livewire:navigated", () => {
    let table = new DataTable('#{{ $id }}',{
        buttons: [
            { 
                
                    extend: 'pdf', 
                    text: "<i class='bi bi-filetype-pdf'></i>",
                    className: "btn-info @if(!in_array('pdf',$headbtn)) d-none @endif ", 
                    titleAttr: 'pdf',
                    exportOptions: {
                        columns: @js($col)
                    }
                
            },
            { 
                extend: 'excel', 
                text: "<i class='bi bi-file-spreadsheet'></i>",
                className: "btn-success @if(!in_array('excel',$headbtn)) d-none @endif", 
                titleAttr: 'excel',
                exportOptions: {
                    columns: @js($col)
                }
            },
            { 
                extend: 'print', 
                text: "<i class='bi bi-printer'></i>",
                className: "btn-warning @if(!in_array('print',$headbtn)) d-none @endif", 
                titleAttr: 'print',
                exportOptions: {
                    columns: @js($col)
                }
            },
            {
                text: "<i class='bi bi-trash'></i>",
                className: "btn-danger @if(!in_array('delete',$headbtn)) d-none @endif", 
                titleAttr: 'delete',
                action: function (e, dt, node, config, cb) {
                    Livewire.dispatch('delAll');
                }
            }
    ],
    layout: {
        topStart: 'buttons'
    },
        columnDefs: [
            {
                orderable: false,
                searchable: false,
                width: '2%',
                render: DataTable.render.select(),
                targets: 0
            },
            {
                visible: false, 
                searchable: false, 
                orderable: false,
                targets: 1
            },
            { width: '2%', targets: [1,2]},
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 3 },
            { responsivePriority: 3, targets: -1 },
            { targets: -1, 
                orderable: false, 
                searchable: false, 
                width: '4%',
                render: function (data, type, row, meta)
                {

                    if(@js($tbtn).includes('edit')){
                        data = data+"<button data-tbl='edit' wire:click='onEdit("+row[1]+")' class='btn btn-sm btn-success me-2' style='width:35px' data-toggle='tooltip' title='Edit' ><i class='bi bi-pencil-square'></i></button>";
                    }

                    if(@js($tbtn).includes('delete')){
                        data = data+"<button data-tbl='del' wire:click='onDelete("+row[1]+")' class='btn btn-sm btn-danger me-2' style='width:35px' data-toggle='tooltip' title='Delete' ><i class='bi bi-trash'></i></button>";
                    }

                    return data;
                }
            }
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [[1, 'asc']],
        paging: true,
        pageLength: 10,
        lengthChange: true,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        searching: true,
        ordering: true,
        responsive: true,
        autoWidth: true,
    });

    table.on( 'select', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
                var nilai = table.rows({ selected: true }).data().pluck(1).toArray();
                //console.log(nilai);
                if(@js($model) !== 'undefined' ){
                    @this.set('{{ $model }}', nilai);
                }
        }
    });

    table.on( 'deselect', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
                var nilai = table.rows({ selected: true }).data().pluck(1).toArray();
                if(@js($model) !== 'undefined' ){
                    @this.set('{{ $model }}', nilai);
                }
        }
    });

},{once:true});
</script>
@endscript
<div wire:ignore>
    <table id="{{ $id }}" class="table display responsive table-striped nowrap" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>No</th>
                @foreach($thead as $r)
                <th>{{ $r }}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tdata as $key=>$row)
            <tr>
                <td></td>
                <td>{{ $row->id }}</td>
                <td>{{1+$key++}}</td>
                @foreach($tbody as $v)
                <td>{{ $row->$v}}</td>
                @endforeach
                <td></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>ID</th>
                <th>No</th>
                @foreach($thead as $r)
                <th>{{ $r }}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
