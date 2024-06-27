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
                        <p> Confirm password </p>
                    </a>
                </li>
                @endif
                @if( (Route::currentRouteName() != 'password.confirm') || (Route::currentRouteName() != 'verification.notice') )
                <li class="nav-item"> 
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                @endif
                @if( (Route::currentRouteName() != 'password.confirm') || (Route::currentRouteName() != 'verification.notice') )
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
                @endif
                @if( (Route::currentRouteName() != 'password.confirm') || (Route::currentRouteName() != 'verification.notice') )
                <li class="nav-item"> 
                    <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile')?'active':'' }}" wire:navigate> 
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p> Profile </p>
                    </a>
                </li>
                @endif
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->