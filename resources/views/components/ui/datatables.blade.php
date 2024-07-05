@assets
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css" />
<script data-navigate-once src="//cdn.datatables.net/2.0.8/js/dataTables.min.js" ></script>
<script data-navigate-once src="//cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js" ></script>
<script data-navigate-once src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js" ></script>
@endassets

@props([
    'id',
    'data',
])

@php
$head=collect(['Nama','Email']);
$cell=collect(['name','email']);
@endphp

@script
<script data-navigate-once>
    let table = new DataTable('#{{ $id }}', {
        paging: true,
        pageLength: 5,
        lengthChange: true,
        lengthMenu: [ [5, 25, 50, 100, -1], [5, 25, 50, 100, "All"] ],
        searching: true,
        ordering: true,
        responsive: true,
        autoWidth: true,
        order: [[1, 'asc']],
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        }
    });
</script>
@endscript

<div wire:ignore>
    <table id="{{ $id }}" class="table display responsive table-striped" style="width:100%" >
        <thead>
            <tr>
                <th></th>
                <th>No</th>
            @foreach($head as $r)
                <th>{{ $r }}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key=>$row)
            <tr>
                <th></th>
                <td>{{1+$key++}}</td>
                @foreach($cell as $v)
                <td>{{ $row->$v}}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>