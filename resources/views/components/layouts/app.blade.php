<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">
    <head>
        <x-metatag />
    </head>
    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
        <x-ui.icondarkmode />
        <x-ui.buttondarkmode />
        <div class="app-wrapper"> <!--begin::Header-->
            <livewire:menu.navigation />
            <livewire:menu.sidebar />
            <main class="app-main"> <!--begin::App Content Header-->
                <x-ui.headernav :dataheader="$header" />
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
