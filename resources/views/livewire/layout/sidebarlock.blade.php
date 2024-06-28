<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <x-sidebarbrand />
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @if(in_array(Route::currentRouteName(),['verification.notice']))
                <li class="nav-item"> 
                    <a href="{{ route('verification.notice') }}" class="nav-link {{ request()->routeIs('verification.notice')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-envelope-check-fill"></i>
                        <p> Verification Email </p>
                    </a>
                </li>
                @endif
                @if(in_array(Route::currentRouteName(),['password.confirm']))
                <li class="nav-item"> 
                    <a href="{{ route('password.confirm') }}" class="nav-link {{ request()->routeIs('password.confirm')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-key-fill"></i>
                        <p> Restricted Access</p>
                    </a>
                </li>
                @endif
                <li class="nav-item"> 
                    <a href="{{ route('profilelock') }}" class="nav-link {{ request()->routeIs('profilelock')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p> Profile </p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->