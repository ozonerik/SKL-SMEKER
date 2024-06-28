<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">
    <head>
        <x-metatag />
    </head>
    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
        <x-icondarkmode />
        <x-buttondarkmode />
        <div class="app-wrapper"> <!--begin::Header-->
            <livewire:layout.navigationlock />
            <livewire:layout.sidebarlock />
            <main class="app-main"> <!--begin::App Content Header-->
                @if (isset($header))
                <div class="app-content-header"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">{{ $header }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}" wire:navigate>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $header }}
                                    </li>
                                </ol>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> <!--end::App Content Header--> <!--begin::App Content-->
                @endif
                <div class="app-content"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        {{ $slot }}
                    </div>
                </div> <!--end::App Content-->
            </main> <!--end::App Main--> <!--begin::Footer-->
        <footer class="app-footer"> <!--begin::To the end-->
            <x-footer />
        </footer> <!--end::Footer-->
        </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
        <x-script />
    </body>
</html>
