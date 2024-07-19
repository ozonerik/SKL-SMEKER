<li class="nav-item dropdown user-menu"> 
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 
        <img src="{{ showimg(auth()->user()->photo) }}" class="user-image rounded-circle shadow" alt="User Image"> 
        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> 
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
        <li class="user-header text-bg-primary"> <img src="{{ showimg(auth()->user()->photo) }}" class="rounded-circle shadow" alt="User Image">
            <p>
                {{ auth()->user()->name }} - {{ \Illuminate\Support\Str::of(auth()->user()->getRoleNames()->implode(''))->ucfirst() }}
                <small>Member since {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('M. Y') }}</small>
            </p>
        </li> <!--end::User Image--> <!--begin::Menu Body-->
        <li class="user-footer">
            <a href="{{ route('profile') }}" class="btn btn-default btn-flat" wire:navigate>Profile</a>
            <button wire:click="logout" class="btn btn-default btn-flat float-end">Log Out</button>
        </li> <!--end::Menu Footer-->
    </ul>
</li> <!--end::User Menu Dropdown-->