<header class="header">
    <div class="content spacer">
        <div class="header__left">
            @foreach($items as $menu_item)

                @if ($menu_item->id == 20)
                        <div class="header__phones">
                            @foreach($menu_item->children as $phone)
                                <a href="tel:{{ $phone->link() }}">{{ $phone->title }}</a>
                            @endforeach
                        </div><!--header__phones-->
                    @else
                        <a href="{{ $menu_item->link() }}" class="header__wapp">
                            <svg class="svg-icon icon-wapp"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-wapp"></use></svg>
                            <span>{{ $menu_item->title }}</span>
                        </a>
                @endif

            @endforeach

        </div><!--header__left-->

        <div class="header__right">
            <a href="{{ url('/comparison') }}" class="header__link">
                <svg class="svg-icon icon-diff"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-diff"></use></svg>
                <span>Сравнение товаров (<span>0</span>)</span>
            </a>

            <a href="{{ url('/wishlist') }}" class="header__link">
                <svg class="svg-icon icon-favorite"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-favorite"></use></svg>
                <span>Список желаний (<span class="wishlist_count">0</span>)</span>
            </a>

            <a href="{{ url('/sign_in') }}" class="header__link">
                <svg class="svg-icon icon-personal"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal"></use></svg>
                <span>вход</span>
            </a>

        </div><!--header__right-->

    </div><!--content-->

</header>

