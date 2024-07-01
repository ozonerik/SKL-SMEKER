<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <x-sidebarbrand />
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @if(in_array(Route::currentRouteName(),['verification.notice']))
                <x-ui.navitem label="Verification Email" link="verification.notice" icon="bi bi-envelope-check-fill" />
                @endif
                @if(in_array(Route::currentRouteName(),['password.confirm']))
                <x-ui.navitem label="Restricted Access" link="password.confirm" icon="bi bi-key-fill" />
                @endif
                <x-ui.navitem label="Profile" link="profilelock" icon="bi bi-person-circle" />
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->