@push('sidebar')
    <aside class="menu">
        @if ($menus)
            @foreach ($menus as $menu)
                <p class="menu-label">
                    {{ $menu['menu_name'] }}
                </p>
                <ul class="menu-list">
                    @foreach ($menu['menu_items'] as $item)
                        <li><a href="{{ $item['item_link'] }}">{{ $item['item_name'] }}</a></li>
                    @endforeach
                </ul>
            @endforeach
        @endif
    </aside>
@endpush
