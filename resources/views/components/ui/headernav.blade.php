@props([
    'dataheader',
])
@php
$dataheader=(isset($dataheader))?explode(',',$dataheader):'blank';
$data=(is_array($dataheader))?collect($dataheader):$dataheader;
$header=(is_array($dataheader))?$data->last():$data;
$len=(is_array($dataheader))?$data->count()-1:'';
@endphp
@if (isset($dataheader))
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ $header }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" wire:navigate>Home</a></li>
                    @if(is_array($dataheader))
                        @foreach ($data->except($header) as $item)
                        @if ($header == $item)
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $header }}
                        </li>
                        @else
                        <li class="breadcrumb-item"><a href="#" wire:navigate>{{ $item }}</a></li>
                        @endif
                        @endforeach
                    @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $header }}
                    </li>
                    @endif

                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
@endif