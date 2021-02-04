<meta name="csrf-token" content="{{ csrf_token() }}" />
<section class="nav-bar">
    <div class="content">
        <a href="{{ url('/') }}" class="logo" style="background: url('{!! Voyager::Image(setting('site.logo')) !!}') no-repeat;">
        </a>
        
        <nav class="nav">
            <div class="spacer">
			    {{-- @foreach($items as $menu_item)
			        <a class="nav__link" href="{{ $menu_item->link() }}" >{{ $menu_item->title }}</a>
			    @endforeach --}}

                @foreach(App\CategoryProduct::get() as $menu_item)
                    <a class="nav__link" href="{{ url('/category/'.preg_replace('/\s+/', '_', $menu_item->name)) }}" >{{ $menu_item->name }}</a>
                @endforeach
            </div><!--spacer-->
        </nav>

        <div class="nav-bar__right">
            <a class="nav-bar__link" >
                <svg class="svg-icon icon-search pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-search"></use></svg>
            </a>

            <a href="{{ url('/cart') }}" class="nav-bar__link">
                <i class="nav-bar__link-count">0</i>
                <svg class="svg-icon icon-basket pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-basket"></use></svg>
            </a>

            <span class="menu__nav"></span>

        </div><!--nav-bar__right-->

    </div><!--content-->

</section><!--nav-bar-->
