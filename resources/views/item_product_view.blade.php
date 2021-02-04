@extends('layouts.app')

@section('content')

    <section class="page page_product content">

        <div class="pager">
            <a href="{{ url('/') }}">Главная</a>
            <i>/</i>
            <a href="#">Каталог</a>
            <i>/</i>
            <a href="{{ url('/category/'.preg_replace('/\s+/', '_', $item_product->product_category[0]->name)) }}">{!! $item_product->product_category[0]->name !!}</a>
            <i>/</i>
            <span>{!! $item_product->name !!}</span>
        </div><!--pager-->

        <div class="product spacer_top">
            <div class="product__slider">
                <div class="product__slides owl-carousel">
                    @php
                        if(json_decode($item_product->photo) && !empty(json_decode($item_product->photo)))
                            $photo = json_decode($item_product->photo);
                        else
                            $photo = null;
                    @endphp

                    @if ($photo != null && !empty($photo))
                        @foreach ($photo as $key => $img)

                            <div class="product__slide" data-index="{!! $key !!}">
                                <img src="{!! Voyager::Image($img) !!}" alt="Слайд">
                            </div><!--product__slide-->

                        @endforeach
                    @endif

                    {{-- <div class="product__slide" data-index="1">
                        <img src="images/products/product-1/slide-1.png" alt="Слайд">
                    </div><!--product__slide--> --}}

                </div><!--product__slides-->

                <div class="product__previews">
                    <div class="product__previews-slides owl-carousel">

                        @if ($photo != null && !empty($photo))
                            @foreach ($photo as $key => $img)
                                
                                <div class="product__preview {!! $key == 0 ? 'active' : '' !!}" data-index="{!! $key !!}">
                                    <img src="{!! Voyager::Image($img) !!}" alt="Превью">
                                </div><!--product__preview-->

                            @endforeach
                        @endif

                        {{-- <div class="product__preview" data-index="1">
                            <img src="images/products/product-1/preview-2.png" alt="Превью">
                        </div><!--product__preview--> --}}

                    </div><!--product__previews-slides-->

                    <span class="product__previews-prev">
                        <svg class="svg-icon icon-product-prev"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-prev"></use></svg>
                    </span>

                    <span class="product__previews-next">
                        <svg class="svg-icon icon-product-next"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-next"></use></svg>
                    </span>

                </div><!--product__previews-->

            </div><!--product__slider-->

            <div class="product__right">
                <h1>
                    {!! $item_product->name !!}
                </h1>

                <p class="product__status">
                    Доступность: <span class="avail">{!! $item_product->availability !!}</span>
                </p>

                <p class="product__index">
                    Код товара: <strong>{!! $item_product->code !!}</strong>
                </p>

                <div class="product__prices">
                    <p class="product__price" id="count__price_{!! $item_product->id !!}" data-value="{!! $item_product->price !!}">
                        {!! $item_product->price . ' ' . setting('site.currency') !!} 
                    </p>

                    <p class="product__price product__price_old">
                        {!! $item_product->old_price . ' ' . setting('site.currency') !!} 
                    </p>

                </div><!--product__prices-->

                @php
                    if(json_decode($item_product->color_image) && !empty(json_decode($item_product->color_image)))
                        $color_img = json_decode($item_product->color_image);
                    else
                        $color_img = null;
                @endphp

                @if (!empty($color_img))
                    <div class="colors">
                        <p class="colors__title">
                            Выберите цвет:
                        </p>
                            
                            <div class="colors__list">

                                @foreach ($color_img as $key => $img)

                                    <div class="colors__color  {!! $key == 0 ? 'active' : '' !!}">
                                        <img src="{!! Voyager::Image($img) !!}" alt="Цвет">
                                    </div><!--colors__color-->

                                @endforeach    

                            </div><!--colors__list-->

                    </div><!--colors-->
                @endif

                <div class="product__controls">
                    <input type="hidden" name="count" value="1" id="item_count_{!! $item_product->id !!}">
                    <div class="count" data-value="{!! $item_product->id !!}" data-count-product="{!! $item_product->count !!}">
                        <span class="count__minus"></span>
                        <span class="count__length" id="count__length_{!! $item_product->id !!}">
                            @if (@count(App\Cart::where('user_id', Session::get('id'))->where('product_id', $item_product->id)->first()) > 0)
                                    {!! App\Cart::where('user_id', Session::get('id'))->where('product_id', $item_product->id)->first()->count !!}
                                @else
                                    1
                            @endif
                        </span>
                        <span class="count__plus"></span>
                    </div><!--count-->

                    <a href="#" class="product__favorite">
                        <svg class="svg-icon icon-favorite"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-favorite"></use></svg>
                        <span>В закладки</span>
                    </a>

                    <a href="#" class="product__diff">
                        <svg class="svg-icon icon-diff"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-diff"></use></svg>
                        <span>Сравнить</span>
                    </a>

                </div><!--product__controls-->

                <div class="product__btns spacer" data-value="{!! $item_product->id !!}">
                    @if (@count(App\Cart::where('user_id', Session::get('id'))->where('product_id', $item_product->id)->first()) > 0)
                            <button class="catalog__item-add p_item_remove p_item_remove_st" style="    margin: 0;">Убрать из корзины</button>
                        @else
                            <button class="yellow-btn product__add p_item_add">Добавить в корзину</button>
                    @endif
                    <button class="product__order">Быстрый заказ</button>
                </div><!--product__btns-->

                <div class="product__bottom">
                    <div class="product__bottom-col">
                        <div class="product__rating">

                            <div class="star-rating" style="display: flex;">
                                <fieldset data-value="{!! $item_product->id !!}">

                                    @for ($i = 5; $i > 0; $i--)
                                        <input type="radio" id="star{{ $i }}" class="g_star" name="rating" value="{{ $i }}" 
                                            @if ( ((int)round(App\Rating::where('product_id', $item_product->id)->avg('star'))) == $i)
                                                checked 
                                            @endif
                                        >
                                        <label for="star{{ $i }}" title="{{ $i }}">{{ $i }} stars</label>
                                    @endfor

                                    {{-- <input type="radio" id="star5" class="g_star" name="rating" value="5" /><label for="star5" title="Outstanding">5 stars</label>
                                    <input type="radio" id="star4" class="g_star" name="rating" value="4" /><label for="star4" title="Very Good">4 stars</label>
                                    <input type="radio" id="star3" class="g_star" name="rating" value="3" /><label for="star3" title="Good">3 stars</label>
                                    <input type="radio" id="star2" class="g_star" name="rating" value="2" /><label for="star2" title="Poor">2 stars</label>
                                    <input type="radio" id="star1" class="g_star" name="rating" value="1" /><label for="star1" title="Very Poor">1 star</label> --}}
                                </fieldset>
                                <div id="product_rating_{!! $item_product->id !!}" class="product_rating">
                                    @if (0 == (int)substr(substr(App\Rating::where('product_id', $item_product->id)->avg('star'), 0, 3), -1))
                                            {!! substr(App\Rating::where('product_id', $item_product->id)->avg('star'), 0, 1) !!}
                                        @else
                                            {!! substr(App\Rating::where('product_id', $item_product->id)->avg('star'), 0, 3) !!}
                                    @endif
                                </div>
                            </div>
{{-- 
                            <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                            <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                            <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                            <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                            <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg> --}}
                        </div><!--product__rating-->

                    </div><!--product__bottom-col-->

                    <div class="product__bottom-col">
                        <p class="product__bottom-desc">{!! @count($item_product->product_review) !!} отзывов</p>
                    </div><!--product__bottom-col-->

                    <div class="product__bottom-col">
                        <a href="{{ url('/set_review/' . $item_product->id) }}" class="product__bottom-link">Оставить отзыв</a>
                    </div><!--product__bottom-col-->

                </div><!--product__bottom-->

                <div class="tabs">
                    <div class="tabs__links">
                        <div class="spacer">
                            <a href="#" class="tabs__link active">Характеристики</a>
                            <a href="#" class="tabs__link">Описание</a>
                            <a href="#" class="tabs__link">Отзывы <i>({!! @count($item_product->product_review) !!})</i></a>
                            {{-- <a href="#" class="tabs__link">Доставка и оплата</a> --}}
                        </div><!--spacer-->

                    </div><!--tabs__links-->

                    <div class="tabs__list">
                        <div class="tab active">
                            <p class="product__desc">
                                <strong>{!! $item_product->name !!}</strong> — {!! $item_product->specifications !!}
                            </p>

                        </div><!--tab-->

                        <div class="tab">
                            <div class="product__params">
                                {!! $item_product->description ?? '' !!}
                                {{-- <div class="product__params-block">
                                    <p class="product__params-title">
                                        Общие характеристики
                                    </p>

                                    <ul class="product__params-list">
                                        <li>
                                            <p>Тип</p>
                                            <p>Ноутбук</p>
                                        </li>

                                        <li>
                                            <p>Операционная система</p>
                                            <p>DOS</p>
                                        </li>

                                        <li>
                                            <p>Модель</p>
                                            <p>Lenovo G505s</p>
                                        </li>

                                    </ul>

                                </div><!--product__params-block-->

                                <div class="product__params-block">
                                    <p class="product__params-title">
                                        Внешний вид
                                    </p>

                                    <ul class="product__params-list">
                                        <li>
                                            <p>Цвет</p>
                                            <p>Черный</p>
                                        </li>

                                    </ul>

                                </div><!--product__params-block-->

                                <div class="product__params-block">
                                    <p class="product__params-title">
                                        Экран
                                    </p>

                                    <ul class="product__params-list">
                                        <li>
                                            <p>Тип экрана</p>
                                            <p>TN+film</p>
                                        </li>

                                        <li>
                                            <p>Диагональ экрана</p>
                                            <p>15.6"</p>
                                        </li>

                                        <li>
                                            <p>Разрешение экрана</p>
                                            <p>1366x768</p>
                                        </li>

                                        <li>
                                            <p>Название формата</p>
                                            <p>HD</p>
                                        </li>

                                        <li>
                                            <p>Плотность пикселей</p>
                                            <p>101 PPI</p>
                                        </li>

                                    </ul>

                                </div><!--product__params-block-->

                                <div class="product__params-block">
                                    <p class="product__params-title">
                                        Процессор
                                    </p>

                                    <ul class="product__params-list">
                                        <li>
                                            <p>Производитель процессора</p>
                                            <p>AMD</p>
                                        </li>

                                        <li>
                                            <p>Линейка процессора</p>
                                            <p>AMD A10</p>
                                        </li>

                                        <li>
                                            <p>Модель процессора</p>
                                            <p>A10-5750M</p>
                                        </li>

                                        <li>
                                            <p>Количество ядер процессора</p>
                                            <p>4</p>
                                        </li>

                                        <li>
                                            <p>Частота</p>
                                            <p>2.5 ГГц</p>
                                        </li>

                                    </ul>

                                </div><!--product__params-block--> --}}

                            </div><!--product__params-->

                        </div><!--tab-->

                        <div class="tab">
                            <div class="reviews">

                                @foreach ($review as $key => $rev)
                                    
                                    <div class="review">
                                        <div class="review__top">
                                            <div class="review__photo">
                                                <svg class="svg-icon icon-user-default"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-user-default"></use></svg>
                                            </div><!--review__photo-->

                                            <p class="review__name">{!! $rev->users_review[0]->name . ' ' . $rev->users_review[0]->surname !!}</p>
                                            <p class="review__date">{!! $rev->created_at !!}</p>

                                            <div class="review__rating">
                                                @for ($i = 0; $i < (int)$rev->star; $i++)
                                                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                                @endfor

                                                @for ($i = 0; $i < 5 - (int)$rev->star; $i++)
                                                    <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                                @endfor
                                               
                                                {{-- <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg> --}}
                                            </div><!--product__rating-->

                                        </div><!--review__top-->

                                        @if (!empty($rev->term_use))
                                            <p class="review__time">
                                                <strong>Срок использования:</strong>
                                                {!! $rev->term_use !!}
                                            </p>
                                        @endif

                                        @if (!empty($rev->dignity))
                                            <div class="review__text">
                                                <p class="review__title">
                                                    Достоинства:
                                                </p>

                                                <p class="review__desc">
                                                    {!! $rev->dignity !!}
                                                </p>

                                            </div><!--review__text-->
                                        @endif

                                        @if (!empty($rev->disadvantages))
                                            <div class="review__text">
                                                <p class="review__title">
                                                    Недостатки:
                                                </p>

                                                <p class="review__desc">
                                                    {!! $rev->disadvantages !!}
                                                </p>

                                            </div><!--review__text-->
                                        @endif


                                        @if (!empty($rev->comment))
                                            <div class="review__text">
                                                <p class="review__title">
                                                    Комментарии:
                                                </p>

                                                <p class="review__desc">
                                                    {!! $rev->comment !!}
                                                </p>
                                            {{-- 
                                                <p class="review__desc">
                                                    Всё таки следует отметить, что видеокарта очень
                                                    хорошая, но драйвер ужасен и другого нет (спросил,
                                                    написали сами разработчики AMD).
                                                </p>

                                                <p class="review__desc">
                                                    Несмотря на минусы, рекомендую к покупке,
                                                    поскольку относительно его цены, чуть ли не
                                                    идеален, самый лучший виз возможных, не уступает
                                                    порой даже игровым.
                                                </p> --}}

                                            </div><!--review__text-->
                                        @endif

                                    </div><!--review-->

                                @endforeach


                                {{-- <div class="review">
                                    <div class="review__top">
                                        <div class="review__photo">
                                            <svg class="svg-icon icon-user-default"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-user-default"></use></svg>
                                        </div><!--review__photo-->

                                        <p class="review__name">Виталий Наумов</p>
                                        <p class="review__date">08.09.2020</p>

                                        <div class="review__rating">
                                            <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                            <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                            <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                            <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                            <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                                        </div><!--product__rating-->

                                    </div><!--review__top-->

                                    <p class="review__time">
                                        <strong>Срок использования:</strong>
                                        Полгода
                                    </p>

                                    <div class="review__text">
                                        <p class="review__title">
                                            Достоинства:
                                        </p>

                                        <p class="review__desc">
                                            Цена, производительность, дизайн. Очень
                                            тихий, СТАРТУЕТ быстро:) , звук отличный
                                            (как для ноута), можно поработать и поиграть
                                            без слез и нервов)
                                        </p>

                                    </div><!--review__text-->

                                    <div class="review__text">
                                        <p class="review__title">
                                            Недостатки:
                                        </p>

                                        <p class="review__desc">
                                            Критичных нет,есть небольшие недочеты.
                                        </p>

                                    </div><!--review__text-->

                                    <div class="review__text">
                                        <p class="review__title">
                                            Комментарии:
                                        </p>

                                        <p class="review__desc">
                                            Больше профессиональный ноутбук чем игровой,
                                            но и с большинством игр справляется, плюс есть
                                            возможность игры AAA категорий.
                                        </p>

                                        <p class="review__desc">
                                            Всё таки следует отметить, что видеокарта очень
                                            хорошая, но драйвер ужасен и другого нет (спросил,
                                            написали сами разработчики AMD).
                                        </p>

                                        <p class="review__desc">
                                            Несмотря на минусы, рекомендую к покупке,
                                            поскольку относительно его цены, чуть ли не
                                            идеален, самый лучший виз возможных, не уступает
                                            порой даже игровым.
                                        </p>

                                    </div><!--review__text-->

                                </div><!--review--> --}}

                            </div><!--reviews-->

                        </div><!--tab-->

                        {{-- <div class="tab">
                            <div class="shipping">
                                <div class="shipping__item">
                                    <svg class="svg-icon icon-shipping-1"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-shipping-1"></use></svg>
                                    <p class="shipping__title">
                                        Самовывоз
                                    </p>

                                    <p class="shipping__desc">
                                        г. Алматы, Бостандыкский район, проспект Абая , 138/2,
                                        3 этаж, 4 офис
                                    </p>

                                </div><!--shipping__item-->

                                <div class="shipping__item">
                                    <svg class="svg-icon icon-shipping-2"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-shipping-2"></use></svg>
                                    <p class="shipping__title">
                                        Самовывоз
                                    </p>

                                    <p class="shipping__desc">
                                        По городу Алматы и Алматинской области доставка
                                        осуществляется в течении 2-3 дней, стоимость
                                        доставки составляет 700 тг.
                                    </p>

                                </div><!--shipping__item-->

                                <div class="shipping__item">
                                    <svg class="svg-icon icon-shipping-3"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-shipping-3"></use></svg>
                                    <p class="shipping__title">
                                        Самовывоз
                                    </p>

                                    <p class="shipping__desc">
                                        По городу Алматы и Алматинской области доставка
                                        осуществляется в течении 2-3 дней, стоимость
                                        доставки составляет 2000 тг.
                                    </p>

                                </div><!--shipping__item-->

                            </div><!--shipping-->

                        </div><!--tab--> --}}

                    </div><!--tabs__list-->

                </div><!--tabs-->

            </div><!--product__right-->

        </div><!--product-->

    </section><!--page-->


    <section class="catalog content">
        <h2>
            рекомендуем
        </h2>

        <div class="catalog__list flex-container">
            @foreach ($products as $product)

                @php
                    if(json_decode($product->photo) && !empty(json_decode($product->photo)))
                        $photo = json_decode($product->photo)[0];
                    else
                        $photo = null;
                @endphp
                
                <div class="catalog__item" data-value="{{ $product->id }}">
                    <a href="{{ url('/item_product_view/' . $product->id) }}" class="catalog__item-photo">
                        <img src="  @if ($photo != null && !empty($photo))
                                        {{ asset('/storage/' . $photo) }}
                                    @endif" alt="{{ $product->name }}">
                    </a>

                    <a href="{{ url('/item_product_view/' . $product->id) }}" class="catalog__item-title">
                        {{ $product->title ? $product->title : '' }}
                    </a>

                    <div class="catalog__item-rating">
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    </div><!--catalog__item-rating-->

                    <p class="catalog__item-status">
                        {{ $product->availability }}
                    </p>

                    <p class="catalog__item-price">
                        {{ $product->price  . ' ' . setting('site.currency') }} 
                    </p>

                    <p class="catalog__item-price catalog__item-price_old">
                        {{ $product->old_price  . ' ' . setting('site.currency') }} 
                    </p>

                    @if (@count(App\Cart::where('user_id', Session::get('id'))->where('product_id', $product->id)->first()) > 0)
                            <button class="catalog__item-add p_item_remove p_item_remove_st ">Убрать из корзины</button>
                        @else
                            <button class="catalog__item-add p_item_add p_item_add_st ">Добавить в корзину</button>
                    @endif

                    <div class="catalog__item-control" data-value="{{ $product->id }}">
                        @if (@count(App\Wishlist::where('user_id', Session::get('id'))->where('product_id', $product->id)->first()) > 0)
                                <a class="catalog__item-link wishlist_p_item_remove">
                                    <svg class="svg-icon icon-product-favorite"><use fill="#F2C94C" xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-favorite"></use></svg>
                                </a>
                            @else
                                <a class="catalog__item-link wishlist_p_item_add">
                                    <svg class="svg-icon icon-product-favorite"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-favorite"></use></svg>
                                </a>
                        @endif
                        

                        @if (@count(App\Comparison::where('user_id', Session::get('id'))->where('product_id', $product->id)->first()) > 0)
                                <a class="catalog__item-link comparison_p_item_remove">
                                    <svg class="svg-icon icon-product-diff"><use fill="#F2C94C" xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-diff"></use></svg>
                                </a>
                            @else
                                <a class="catalog__item-link comparison_p_item_add">
                                    <svg class="svg-icon icon-product-diff"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-diff"></use></svg>
                                </a>
                        @endif
                        

                        <a href="{{ url('/item_product_view/' . $product->id) }}" class="catalog__item-link">
                            <svg class="svg-icon icon-product-view"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-view"></use></svg>
                        </a>

                    </div><!--catalog__item-control-->

                </div><!--catalog__item-->
            @endforeach

        </div><!--catalog__list-->

    </section><!--catalog-->

    <section class="catalog catalog_second content">
        <h2>
            рекомендуем
        </h2>

        <div class="catalog__list flex-container">
            @foreach ($new_products as $new_pro)

                @php
                    if(json_decode($new_pro->photo) && !empty(json_decode($new_pro->photo)))
                        $photo = json_decode($new_pro->photo)[0];
                    else
                        $photo = null;
                @endphp
                
                <div class="catalog__item" data-value="{{ $new_pro->id }}">
                    <a href="{{ url('/item_product_view/' . $new_pro->id) }}" class="catalog__item-photo">
                        <img src="  @if ($photo != null && !empty($photo))
                                        {{ asset('/storage/' . $photo) }}
                                    @endif" alt="{{ $new_pro->name }}">
                    </a>

                    <span class="catalog__item-tag">new</span>

                    <a href="{{ url('/item_product_view/' . $new_pro->id) }}" class="catalog__item-title">
                        {{ $new_pro->title ? $new_pro->title : '' }}
                    </a>

                    <div class="catalog__item-rating">
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    </div><!--catalog__item-rating-->

                    <p class="catalog__item-status">
                        {{ $new_pro->availability }}
                    </p>

                    <p class="catalog__item-price">
                        {{ $new_pro->price  . ' ' . setting('site.currency') }} 
                    </p>

                    <p class="catalog__item-price catalog__item-price_old">
                        {{ $new_pro->old_price  . ' ' . setting('site.currency') }} 
                    </p>

                    @if (@count(App\Cart::where('user_id', Session::get('id'))->where('product_id', $new_pro->id)->first()) > 0)
                            <button class="catalog__item-add p_item_remove p_item_remove_st ">Убрать из корзины</button>
                        @else
                            <button class="catalog__item-add p_item_add p_item_add_st ">Добавить в корзину</button>
                    @endif

                    <div class="catalog__item-control" data-value="{{ $new_pro->id }}">
                        @if (@count(App\Wishlist::where('user_id', Session::get('id'))->where('product_id', $new_pro->id)->first()) > 0)
                                <a class="catalog__item-link wishlist_p_item_remove">
                                    <svg class="svg-icon icon-product-favorite"><use fill="#F2C94C" xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-favorite"></use></svg>
                                </a>
                            @else
                                <a class="catalog__item-link wishlist_p_item_add">
                                    <svg class="svg-icon icon-product-favorite"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-favorite"></use></svg>
                                </a>
                        @endif
                        

                        @if (@count(App\Comparison::where('user_id', Session::get('id'))->where('product_id', $new_pro->id)->first()) > 0)
                                <a class="catalog__item-link comparison_p_item_remove">
                                    <svg class="svg-icon icon-product-diff"><use fill="#F2C94C" xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-diff"></use></svg>
                                </a>
                            @else
                                <a class="catalog__item-link comparison_p_item_add">
                                    <svg class="svg-icon icon-product-diff"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-diff"></use></svg>
                                </a>
                        @endif
                        

                        <a href="{{ url('/item_product_view/' . $new_pro->id) }}" class="catalog__item-link">
                            <svg class="svg-icon icon-product-view"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-view"></use></svg>
                        </a>

                    </div><!--catalog__item-control-->

                </div><!--catalog__item-->
            @endforeach


        </div><!--catalog__list-->

    </section><!--catalog-->

    @if (!Session::has('id'))

        <script type="text/javascript">
            $(document).on('click', '.count__minus', function(event) {
                if (Number($('#count__length_' + "{!! $item_product->id !!}").html()) > 1 && Number($('#count__length_' + "{!! $item_product->id !!}").html()) < Number($(this).parent().attr('data-count-product'))) 
                {
                    let length = $('#count__length_' + "{!! $item_product->id !!}")
                    let count = $('#item_count_' + "{!! $item_product->id !!}")
                    let price = $('#count__price_' + "{!! $item_product->id !!}")

                    count.val(Number(count.val()) - 1)
                    length.html(Number(count.val()))
                    price.html(Number(price.attr('data-value')) * Number(count.val()) + ' {!! setting('site.currency') !!}')
                }
            });


            $(document).on('click', '.count__plus', function(event) {
                if (Number($('#count__length_' + "{!! $item_product->id !!}").html()) >= 1 && Number($('#count__length_' + "{!! $item_product->id !!}").html()) < Number($(this).parent().attr('data-count-product'))) 
                {
                    let length = $('#count__length_' + "{!! $item_product->id !!}")
                    let count = $('#item_count_' + "{!! $item_product->id !!}")
                    let price = $('#count__price_' + "{!! $item_product->id !!}")

                    count.val(Number(count.val()) + 1)
                    length.html(Number(count.val()))
                    price.html(Number(price.attr('data-value')) * Number(count.val()) + ' {!! setting('site.currency') !!}')
                }
            });
        </script>

    @endif
   
@endsection