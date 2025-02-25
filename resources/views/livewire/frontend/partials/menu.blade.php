<?php
$menu = \App\Models\MenuItems::orderBy('order_id', 'asc')->get();
?>

@foreach($menu as $index => $item)
    @if($item->is_dropdown_parent == 0 && $item->parent_id == 0)
        <li class="nav-item">
            <a class="nav-link @if($item->pages->route == $page->route)active @endif" href="/{{$item->pages->route}}">{{$item->title}}</a>
        </li>
    @endif
        <?php $children = \App\Models\MenuItems::where('parent_id', $item->id)->get();?>
    @if($children)
        <ul class="dropdown-menu">
            @if($item->is_dropdown_parent == '1')
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$item->title}}
                </a>
            @endif
            <ul class="dropdown-menu">
                @foreach($children as $child)
                    <li><a class="dropdown-item" href="../{{$child->pages->route}}">{{$child->title}}</a></li>
                @endforeach
            </ul>
        </ul>
    @endif
@endforeach
