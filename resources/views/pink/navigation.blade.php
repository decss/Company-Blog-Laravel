@if($menu)
    <div class="menu classic">
        <ul id="nav" class="menu">
            @include(config('config.theme') . '.menuItems', ['items' => $menu->roots()])
        </ul>
    </div>
@endif