@props([
    'id',
    'title',
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
$model=isset($model)?$model:null;
@endphp

@assets
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
<!-- checkbox -->
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css" />
<!-- checkbox -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" />

<script data-navigate-once src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<!-- checkbox -->
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>
<!-- responsive -->
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js" ></script>

@endassets
@script
<script data-navigate-once>
document.addEventListener("livewire:navigated", () => {
    let table = new DataTable('#{{ $id }}',{
        columnDefs: [
            @if(isset($model))
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
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 3 },
            @endif

            @if(isset($model))
            { width: '2%', targets: [1,2]},
            @else
            { width: '2%', targets: [0]},
            @endif

            @if(count($tbtn)>0)
            { responsivePriority: 3, targets: -1 },
            { targets: -1, 
                orderable: false, 
                searchable: false, 
                width: '4%',
                render: function (data, type, row, meta)
                {

                    if(@js($tbtn).includes('edit')){
                        data = data+"<button wire:click='onEdit("+row[1]+")' class='btn btn-sm btn-success me-2' style='width:35px' data-toggle='tooltip' title='edit' ><i class='bi bi-pencil-square'></i></button>";
                    }

                    if(@js($tbtn).includes('delete')){
                        data = data+"<button wire:click='onDelete("+row[1]+")' class='btn btn-sm btn-danger me-2' style='width:35px' data-toggle='tooltip' title='delete' ><i class='bi bi-trash'></i></button>";
                    }

                    return data;
                }
            }
            @endif

        ],

        select: {
            style: "{{isset($model)?'multi':'os'}}",
            selector: 'td:first-child'
        },

        order: [
            ["{{isset($model)?'2':'0'}}", 'asc']
            
        ],
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
                    if(@js($model) !== undefined){
                        @this.set('{{ $model }}', nilai);
                    }
                    
                    
            }
        });
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                    var nilai = table.rows({ selected: true }).data().pluck(1).toArray();
                    if(@js($model) !== undefined){
                        @this.set('{{ $model }}', nilai);
                    }
            }
        });


    

},{once:true});
</script>
@endscript
<div class="row">
@if(isset($title))
<div class="col-12 text-center">
    <h4><strong>{{ $title }}</strong></h4>
</div>
@endif
@if(count($headbtn)>0)
<div class="col-12 text-center text-md-start">
    <div class="btn-group mb-2" role="group" aria-label="Basic example">
        @if(in_array('add',$headbtn))
        <button type="button" wire:click="add" class="btn btn-primary" data-toggle='tooltip' title='add data' ><i class="bi bi-plus-lg"></i></button>
        @endif
        @if(in_array('pdf',$headbtn))
        <button type="button" wire:click="generatePDF" class="btn btn-success" data-toggle='tooltip' title='export to pdf' ><i class="bi bi-filetype-pdf"></i></button>
        @endif
        @if(in_array('delete',$headbtn))
        <button type="button" wire:click="delSel" class="btn btn-danger" data-toggle='tooltip' title='delete selected'><i class="bi bi-trash"></i></button>
        @endif
        @if(in_array('edit',$headbtn))
        <button type="button" wire:click="editSel" class="btn btn-info" data-toggle='tooltip' title='edit selected'><i class="bi bi-pencil-square"></i></button>
        @endif
    </div>
</div>
@endif
<div class="col-12" wire:ignore>
    <table id="{{ $id }}" class="table display responsive table-striped nowrap" style="width:100%">
        <thead>
            <tr>
                @if(!empty($model))
                <th></th>
                <th>ID</th>
                @endif
                <th>No</th>
                @foreach($thead as $r)
                <th>{{ $r }}</th>
                @endforeach
                @if(count($tbtn)>0)
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($tdata as $key=>$row)
            <tr>
                @if(!empty($model))
                <td></td>
                <td>{{ $row->id }}</td>
                @endif
                <td>{{1+$key++}}</td>
                @foreach($tbody as $v)
                <td>{{ $row->$v}}</td>
                @endforeach
                @if(count($tbtn)>0)
                <td></td>
                @endif
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @if(!empty($model))
                <th></th>
                <th>ID</th>
                @endif
                <th>No</th>
                @foreach($thead as $r)
                <th>{{ $r }}</th>
                @endforeach
                @if(count($tbtn)>0)
                <th>Action</th>
                @endif
            </tr>
        </tfoot>
    </table>
</div>
