<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ url('/') }}" class="brand-link" wire:navigate> <!--begin::Brand Image--> <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> 
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(),['adminpage','optpage','userpage'])?'menu-open':'' }} "> 
                    <a href="#" class="nav-link {{ in_array(Route::currentRouteName(),['adminpage','optpage','userpage'])?'active':'' }}"> 
                    <i class="nav-icon bi bi-file-earmark-fill"></i>
                        <p>
                            Halaman
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @hasanyrole('admin')
                        <li class="nav-item"> 
                            <a href="{{ route('adminpage') }}" class="nav-link {{ request()->routeIs('adminpage')?'active':'' }}" wire:navigate> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Admin</p>
                            </a> 
                        </li>
                        @endrole
                        @hasanyrole('admin|operator')
                        <li class="nav-item"> 
                            <a href="{{ route('optpage') }}" class="nav-link {{ request()->routeIs('optpage')?'active':'' }}" wire:navigate> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Operator</p>
                            </a> 
                        </li>
                        @endrole
                        @hasanyrole('admin|operator|user')
                        <li class="nav-item"> 
                            <a href="{{ route('userpage') }}" class="nav-link {{ request()->routeIs('userpage')?'active':'' }}" wire:navigate> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>User</p>
                            </a> 
                        </li>
                        @endrole
                    </ul>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->