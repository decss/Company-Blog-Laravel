@if($menu)
    <div class="menu classic">
        <ul id="nav" class="menu">
            @include(config('config.theme') . '.menuItems', ['items' => $menu->roots()])
            <li>
                <a href="/admin">Admin panel</a>
            </li>
        </ul>
    </div>
@endif