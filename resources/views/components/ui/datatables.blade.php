@props([
    'id',
    'tdata',
    'thead',
    'tbody',
    'model',
    'tbtn'
])

@php
$id=isset($id)?$id:'sample';
$tdata=isset($tdata)?$tdata:collect([]);
$thead=isset($thead)?$thead:collect([]);
$tbody=isset($tbody)?$tbody:collect([]);
@endphp

@assets
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" />

<script data-navigate-once src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js" ></script>
@endassets
@script
<script data-navigate-once>
document.addEventListener("livewire:navigated", () => {
    let table = new DataTable('#{{ $id }}',{
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
            { targets: -1, orderable: false, searchable: false, render: function (data, type, row, meta)
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
