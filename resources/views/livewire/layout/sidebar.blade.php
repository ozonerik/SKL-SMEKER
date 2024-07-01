<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <x-sidebarbrand />
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <x-ui.navitem label="Dashboard" link="dashboard" icon="bi bi-speedometer" />
                <x-ui.navitem :data="[
                    ['label'=>'Admin','icon'=>'bi bi-circle','routename'=>'adminpage','roles'=>'admin'],
                    ['label'=>'Operator','icon'=>'bi bi-circle','routename'=>'optpage','roles'=>'admin|operator'],
                    ['label'=>'User','icon'=>'bi bi-circle','routename'=>'userpage','roles'=>'admin|operator|user'],
                ]" label="Halaman" icon="bi bi-file-earmark-fill" />
                <x-ui.navitem label="Profile" link="profile" icon="bi bi-person-circle" />
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->