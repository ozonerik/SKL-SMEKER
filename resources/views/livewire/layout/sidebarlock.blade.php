<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <x-sidebarbrand />
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->email_verified_at == null)
                <li class="nav-item"> 
                    <a href="{{ route('verification.notice') }}" class="nav-link {{ request()->routeIs('verification.notice')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-envelope-check-fill"></i>
                        <p> Verification Email </p>
                    </a>
                </li>
                @endif
                <li class="nav-item"> 
                    <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p> Profile </p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->