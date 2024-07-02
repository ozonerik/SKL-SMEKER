@props([
    'img',
    'profilelink'
])
@php
$img=(isset($img))?$img:'dist/assets/img/user2-160x160.jpg';
$profilelink=(isset($profilelink))?$profilelink:'profile';
@endphp
<li class="nav-item dropdown user-menu"> 
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 
        <img src="{{ asset($img) }}" class="user-image rounded-circle shadow" alt="User Image"> 
        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> 
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
        <li class="user-header text-bg-primary"> <img src="{{ asset($img) }}" class="rounded-circle shadow" alt="User Image">
            <p>
                {{ Auth::user()->name }} - {{ \Illuminate\Support\Str::of(Auth::user()->getRoleNames()->implode(''))->ucfirst() }}
                <small>Member since {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M. Y') }}</small>
            </p>
        </li> <!--end::User Image--> <!--begin::Menu Body-->
        <li class="user-footer">
            <a href="{{ route($profilelink) }}" class="btn btn-default btn-flat" wire:navigate>Profile</a>
            <button wire:click="logout" class="btn btn-default btn-flat float-end">Log Out</button>
        </li> <!--end::Menu Footer-->
    </ul>
</li> <!--end::User Menu Dropdown-->