@extends('layouts.app')

@section('content')

    {{ slider('main slider', 'sliders.main_slider') }}

    


    <section class="categories content">
        <h2>
            категории товаров
        </h2>

        <div class="categories__list flex-container">
            @foreach ($categoris as $cat)

                @if (@count(json_decode($cat->category_tag_id)) > 0)
                    <div class="category category_1">

                        <a href="{{ url('$cat->url') }}" class="category__title">{{ $cat->name }}</a>
                        <div class="category__links">
                            @foreach(json_decode($cat->category_tag_id) as $item => $tag)
                                <a href="{{ url('/category/' . preg_replace('/\s+/', '_', $cat->name) . '/' . preg_replace('/\s+/', '_', App\Tags::where('id', $tag)->first('name')->name)) }}" class="category__link">{{ App\Tags::where('id', $tag)->first('name')->name  }}</a>
                            @endforeach
                        </div><!--category__links-->

                        <i class="category__bg category__bg_1" style="background: url('{!! Voyager::Image($cat->image) !!}');"></i>

                    </div><!--category-->
                @endif
                
            @endforeach



            {{-- <div class="category category_2">
                <a href="#" class="category__title">комплектующие</a>
                <div class="category__links">
                    <a href="#" class="category__link">материнские платы</a>
                    <a href="#" class="category__link">процессоры</a>
                    <a href="#" class="category__link">Оперативная память (ОЗУ)</a>
                    <a href="#" class="category__link">видеокарта</a>
                    <a href="#" class="category__link">HDD диски</a>
                    <a href="#" class="category__link">SSD диски</a>
                    <a href="#" class="category__link">охлаждение</a>
                    <a href="#" class="category__link">блок питания</a>
                    <a href="#" class="category__link">корпусы</a>
                </div><!--category__links-->

                <i class="category__bg category__bg_2"></i>

            </div><!--category-->--}}

        </div><!--categories__list-->

    </section><!--categories-->

    <section class="app">
        <div class="content">
            <p class="app__title">
                Мы также предоставляем услуги сервисного обслуживания:
            </p>

            <ul class="app__services">
                <li>ремонт компьютеров и ноутбуков</li>
                <li>гарантийное обслуживание</li>
            </ul>

            <button class="app__btn">Оставить заявку</button>

        </div><!--content-->

    </section><!--app-->

    {{ slider('brands', 'sliders.brands') }}

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

                    <div class="star-rating" style="display: flex;">
                        <fieldset data-value="{!! $product->id !!}">

                            @for ($i = 5; $i > 0; $i--)
                                <input type="radio" id="star{{ $product->id . '_' . $i }}" class="g_star" name="rating_{{ $product->id }}" value="{{ $i }}" 
                                    @if ( ((int)round(App\Rating::where('product_id', $product->id)->avg('star'))) == $i)
                                        checked 
                                    @endif
                                >
                                <label for="star{{ $product->id . '_' . $i }}" title="{{ $i }}">{{ $i }} stars</label>
                            @endfor

                        </fieldset>
                        <div id="product_rating_{!! $product->id !!}" class="product_rating">

                                @if (0 == (int)substr(substr(App\Rating::where('product_id', $product->id)->avg('star'), 0, 3), -1))
                                        {!! substr(App\Rating::where('product_id', $product->id)->avg('star'), 0, 1) !!}
                                    @else
                                        {!! substr(App\Rating::where('product_id', $product->id)->avg('star'), 0, 3) !!}
                                @endif
                                
                        </div>
                    </div>

                    {{-- <div class="catalog__item-rating">
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                        <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    </div><!--catalog__item-rating--> --}}

                    <p class="catalog__item-status">
                        {{ $product->availability }}
                    </p>

                    <p class="catalog__item-price">
                        {{ $product->price . ' ' . setting('site.currency') }}
                    </p>

                    <p class="catalog__item-price catalog__item-price_old">
                        {{ $product->old_price . ' ' . setting('site.currency') }}
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





{{-- 
            <div class="catalog__item">
                <a href="#" class="catalog__item-photo">
                    <img src="images/catalog/product-2.png" alt="Фото">
                </a>

                <a href="#" class="catalog__item-title">
                    USB-гарнитура с настраиваемой
                    Razer Chroma подсветкой ушек
                </a>

                <div class="catalog__item-rating">
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                    <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg#icon-star') }}"></use></svg>
                </div><!--catalog__item-rating-->

                <p class="catalog__item-status">
                    В наличии
                </p>

                <p class="catalog__item-price">
                    28  . ' ' . setting('site.currency')500
                </p>

                <button class="catalog__item-add">Добавить в корзину</button>

                <div class="catalog__item-control">
                    <a href="#" class="catalog__item-link">
                        <svg class="svg-icon icon-product-favorite"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-favorite"></use></svg>
                    </a>

                    <a href="#" class="catalog__item-link">
                        <svg class="svg-icon icon-product-diff"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-diff"></use></svg>
                    </a>

                    <a href="#" class="catalog__item-link">
                        <svg class="svg-icon icon-product-view"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-product-view"></use></svg>
                    </a>

                </div><!--catalog__item-control-->

            </div><!--catalog__item-->--}}

        </div><!--catalog__list-->

    </section><!--catalog-->

@endsection