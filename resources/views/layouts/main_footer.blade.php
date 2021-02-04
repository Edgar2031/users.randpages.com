 <footer class="footer">
    <div class="content spacer_top">
        <div class="footer__contacts">
            <a href="#" class="footer__logo" style="background: url('{!! Voyager::Image(setting('site.footer_logo')) !!}') no-repeat;">
            </a>

            @foreach($items as $menu_item)
                {{-- {{ dd($menu_item) }} --}}
                @if ($menu_item->icon_class == 'tel')

                        <div class="footer__contact">
                            <span class="footer__contact-icon">
                                <svg class="svg-icon icon-phone pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-phone"></use></svg>
                            </span>

                            <p class="footer__contact-desc">
                                <a href="tel:{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
                            </p>

                        </div><!--footer__contact-->
                
                    @elseif($menu_item->icon_class == 'icon-time' || $menu_item->icon_class == 'icon-mark')

                        <div class="footer__contact">
                            <span class="footer__contact-icon">
                                <svg class="svg-icon icon-time pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#{{ $menu_item->icon_class }}"></use></svg>
                            </span>

                            <p class="footer__contact-desc">
                                {{ $menu_item->title }}
                            </p>

                        </div>

                @endif

            @endforeach
            {{-- <div class="footer__contact">
                <span class="footer__contact-icon">
                    <svg class="svg-icon icon-time pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-time"></use></svg>
                </span>

                <p class="footer__contact-desc">
                    Понедельник - Пятница С 10:00 до 19:00 <br>
                    Суббота - Воскресенье С 11:00 до 17:00
                </p>

            </div><!--footer__contact-->

            <div class="footer__contact">
                <span class="footer__contact-icon">
                    <svg class="svg-icon icon-mark pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-mark"></use></svg>
                </span>

                <p class="footer__contact-desc">
                    Абая проспект, 138/2 3 этаж; 4 офис
                    Бостандыкский район, Алматы, 050046/A15H5P6
                </p>

            </div><!--footer__contact--> --}}

            <div class="social">
                <a href="#" class="social__link">
                    <svg class="svg-icon icon-social-inst"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-social-inst"></use></svg>
                </a>

                <a href="#" class="social__link">
                    <svg class="svg-icon icon-social-wapp"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-social-wapp"></use></svg>
                </a>

            </div><!--social-->

        </div><!--footer__contacts-->


        @foreach($items as $menu_item)
            @if ($menu_item->icon_class == 'categorias')

                    <div class="footer__col">
                        <p class="footer__col-title">
                            {{ $menu_item->title }}
                        </p>

                        <ul class="site-map">

                            @foreach(App\CategoryProduct::get() as $is)
                                <li>
                                    <a href="{{ url('/category/'.preg_replace('/\s+/', '_', $is->name)) }}">{!! mb_ucfirst($is->name) !!}</a>
                                </li>
                            @endforeach

                        </ul>

                    </div><!--footer__col-->

                @elseif($menu_item->icon_class == 'information')
                    <div class="footer__col">
                        <p class="footer__col-title">
                            {{ $menu_item->title }}
                        </p>

                        <ul class="site-map">
                            @foreach($menu_item->children as $is)
                                <li>
                                    <a href="{{ $is->link() }}">{{ $is->title }}</a>
                                </li>
                            @endforeach

                            {{-- <li>
                                <a href="#">Комплектующие</a>
                            </li>

                            <li>
                                <a href="#">Ноутбуки</a>
                            </li>

                            <li>
                                <a href="#">Перифирия</a>
                            </li>

                            <li>
                                <a href="#">Сервисный центр</a>
                            </li>
     --}}
                        </ul>

                    </div><!--footer__col-->
                @elseif($menu_item->icon_class == 'map')
                    <div class="footer__col">
                        <p class="footer__col-title">
                            {{ $menu_item->title }}
                        </p>

                        <div id="map"></div>

                    </div><!--footer__col-->
            @endif
        @endforeach
        {{-- <div class="footer__col">
            <p class="footer__col-title">
                ИНФОРМАЦИЯ
            </p>

            <ul class="site-map">
                <li>
                    <a href="#">О нас</a>
                </li>

                <li>
                    <a href="#">Информация о доставке</a>
                </li>

                <li>
                    <a href="#">Политика безопасности</a>
                </li>

                <li>
                    <a href="#">Условия соглашения</a>
                </li>

                <li>
                    <a href="#">Личный кабинет</a>
                </li>

                <li>
                    <a href="#">История заказов</a>
                </li>

            </ul>

        </div><!--footer__col--> --}}

        

    </div><!--content-->

    <div class="footer__bottom">
        <div class="content spacer">
            <p class="copyright">
                <svg class="svg-icon icon-copyright"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-copyright"></use></svg>
                <span>2020, Все права защищены</span>
            </p>

            <p class="dev">
                Разработано в <a href="#">NIDGE Digital Agency</a>
            </p>

        </div><!--content-->

    </div><!--footer__bottom-->

</footer>