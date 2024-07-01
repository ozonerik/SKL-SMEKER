@props([
    'data',
    'icon',
    'label',
    'link'
])
@php
$data=(isset($data)) ? collect($data) : collect([]);
$link=(isset($link)) ? route($link) : '#';
$dataroute=$data->pluck('routename')->toArray();
$icon=(isset($icon)) ? $icon : 'bi bi-circle';
$label=(isset($label)) ? $label : 'page';
@endphp
<li class="nav-item @if($data->isNotEmpty()) {{ in_array(Route::currentRouteName(),$dataroute)?'menu-open':'' }} @endif"> 
    <a href="{{ $link }}" class="nav-link @if($data->isNotEmpty()) {{ in_array(Route::currentRouteName(),$dataroute)?'active':'' }} @else {{ request()->routeIs($link)?'active':'' }} @endif" {{ ($data->isEmpty())?'wire:navigate':'' }} > 
    <i class="nav-icon {{ $icon }}"></i>
        <p>
            {{ $label }}
            @if($data->isNotEmpty())
            <i class="nav-arrow bi bi-chevron-right"></i>
            @endif
        </p>
    </a>
    @if($data->isNotEmpty())
    <ul class="nav nav-treeview">
    @foreach($data as $item)
        @hasanyrole($item['roles'])
        <li class="nav-item"> 
            <a href="{{ route($item['routename']) }}" class="nav-link {{ request()->routeIs($item['routename'])?'active':'' }}" wire:navigate> 
                <i class="nav-icon {{ $item['icon'] }}"></i>
                <p>{{ $item['label'] }}</p>
            </a> 
        </li>
        @endrole
    @endforeach
    </ul>
    @endif
</li>