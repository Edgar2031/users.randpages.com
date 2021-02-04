@extends('layouts.app')

@section('content')

    <section class="page content">
        <div class="pager">
            <a href="{{ url('/') }}">Главная</a>
            <i>/</i>
            <a href="#">Каталог</a>
            <i>/</i>
            <span>{!! mb_ucfirst(preg_replace('/\_+/', ' ', $category)) !!}</span>
        </div><!--pager-->

        <form class="catalog-page spacer_top">
            <aside class="filter">
                <span class="filter__btn">
                    Фильтр <i></i>
                </span>

                <div class="filter__content">
                    <div class="filter__block open">
                        <p class="filter__block-title">
                            <span>Цена</span>
                            <svg class="svg-icon icon-filter-arrow"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-filter-arrow"></use></svg>
                        </p>

                        <div class="filter__block-content">
                            <div class="scale">
                                <div class="scale__prices">
                                    <div class="scale__price">
                                        <span class="scale__price-desc">от</span>
                                        <input type="text" class="scale__price-field" id="scaleFrom" disabled="" name="price_of" value="0">
                                    </div><!--scale__price-->

                                    <div class="scale__price">
                                        <span class="scale__price-desc">до</span>
                                        <input type="text" class="scale__price-field" id="scaleTo" disabled="" name="price_to" value="1 500 000">
                                    </div><!--scale__price-->

                                </div><!--scale__prices-->

                                <div id="scaleLine"></div>

                            </div><!--scale-->

                        </div><!--filter__block-content-->

                    </div><!--filter__block-->

                    <div class="filter__block open">
                        <p class="filter__block-title">
                            <span>Производитель</span>
                            <svg class="svg-icon icon-filter-arrow"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-filter-arrow"></use></svg>
                        </p>

                        <div class="filter__block-content">
                            @foreach (App\Manufacturers::where('status', 'publish')->get() as $manufacturer)
                                
                                @php
                                    $cat_id = App\CategoryProduct::where('name', preg_replace('/\_+/', ' ', $category))->first();

                                    $products = App\Product::where('status', 'publish')
                                                        ->where('cat_id', $cat_id->id)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
                                    $arr = [];
                                    foreach ($products as $key) 
                                    {
                                        if (!empty(json_decode($key->product_manufacturer)))
                                        {
                                            foreach (json_decode($key->product_manufacturer) as $value)
                                            {
                                                if ((int)$value == (int)$manufacturer->id) 
                                                {
                                                    $arr[] = $key;
                                                }
                                            }
                                        }  
                                    }
                                @endphp

                                <label class="checkbox">
                                    <input type="radio" name="manufacturer" value="{!! $manufacturer->name !!}">
                                    <span class="checkbox__btn">
                                        <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                    </span>
                                    <span class="checkbox__title">{!! $manufacturer->name !!}</span>
                                    <span class="checkbox__count">{!! @count($arr) !!}</span>
                                </label>

                            @endforeach
                            {{-- <label class="checkbox">
                                <input type="checkbox">
                                <span class="checkbox__btn">
                                    <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                </span>
                                <span class="checkbox__title">Lenovo</span>
                                <span class="checkbox__count">16</span>
                            </label> --}}

                            
                            {{-- <a href="#" class="filter__block-else">Показать еще</a> --}}

                        </div><!--filter__block-content-->

                    </div><!--filter__block-->

                    <div class="filter__block open">
                        <p class="filter__block-title">
                            <span>Цвет</span>
                            <svg class="svg-icon icon-filter-arrow"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-filter-arrow"></use></svg>
                        </p>

                        <div class="filter__block-content">
                            <label class="checkbox">
                                <input type="radio" name="color" value="">
                                <span class="checkbox__btn">
                                    <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                </span>
                                <span class="checkbox__title">Белый</span>
                            </label>

                            <label class="checkbox">
                                <input type="radio" name="color" value="">
                                <span class="checkbox__btn">
                                    <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                </span>
                                <span class="checkbox__title">Серый</span>
                            </label>

                            <label class="checkbox">
                                <input type="radio" name="color" value="">
                                <span class="checkbox__btn">
                                    <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                </span>
                                <span class="checkbox__title">Серебристый</span>
                            </label>

                            <label class="checkbox">
                                <input type="radio" name="color" value="">
                                <span class="checkbox__btn">
                                    <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                </span>
                                <span class="checkbox__title">Розовый</span>
                            </label>

                            <label class="checkbox">
                                <input type="radio" name="color" value="">
                                <span class="checkbox__btn">
                                    <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                                </span>
                                <span class="checkbox__title">Черный</span>
                            </label>

                            {{-- <a href="#" class="filter__block-else">Показать еще</a> --}}

                        </div><!--filter__block-content-->

                    </div><!--filter__block-->

                </div><!--filter__content-->

            </aside>

            <div class="catalog-page__content">
                <h1>
                    {!! mb_ucfirst(preg_replace('/\_+/', ' ', $category)) !!}
                </h1>

                <div class="catalog__panel">
                    <div class="catalog__types">
                        @php
                            $cat = App\CategoryProduct::where('name', preg_replace('/\_+/', ' ', $category))->first();
                        @endphp
                        @if (@count(App\CategoryProduct::where('id', $cat->id)->get()) > 0)
                            @foreach(json_decode(App\CategoryProduct::where('id', $cat->id)->first('category_tag_id')->category_tag_id) as $item => $tag_id)
                                <a  href="{{ 
                                            url('/category/' 
                                                . preg_replace('/\s+/', '_', $cat->name) 
                                                . '/' 
                                                . preg_replace('/\s+/', '_', App\Tags::where('id', $tag_id)->first('name')->name)) 
                                        }}"

                                    class="catalog__type 
                                        @if (!empty($tag))
                                            @if ($tag_id == $tag->id) 
                                                {{ 'active' }}  
                                            @endif
                                        @endif">

                                    {{ App\Tags::where('id', $tag_id)->first('name')->name }}
                                </a>
                            @endforeach
                        @else
                            {{ __('voyager::generic.none') }}
                        @endif
                    </div><!--catalog__types-->

                    <div class="catalog__panel-right">
            {{--             <div class="catalog__view">
                            <a href="#" class="catalog__view-type active">
                                <svg class="svg-icon icon-view-type-1 pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-view-type-1"></use></svg>
                            </a>

                            <a href="#" class="catalog__view-type">
                                <svg class="svg-icon icon-view-type-2 pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-view-type-2"></use></svg>
                            </a>

                        </div><!--catalog__view--> --}}


                        <div class="sort">
                            <p class="sort__title">Сортировать:</p>

                            <div class="select">
                                {{-- <p class="select__selected">По умолчанию</p>
                                <svg class="svg-icon icon-select-arrow"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-select-arrow"></use></svg> --}}
                                <div class="filter__block" style="background: #FFFFFF; box-shadow: 0 4px 15px rgba(229, 229, 229, 0.5); border-radius: 5px; border-bottom: 1px solid #E5E5E5; border-left: 1px solid #E5E5E5; border-right: 1px solid #E5E5E5;padding: 0; margin: 0;">
                                    <p class="filter__block-title">
                                        <span class="select__selected">По умолчанию</span>
                                        <svg class="svg-icon icon-filter-arrow" style="right: 10px; top: 25%;"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-filter-arrow"></use></svg>
                                    </p>

                                    <div class="filter__block-content" style="margin-top: 5px; display: none;">

                                        <a href="@if ($category && !$tag) {{ url('/category/' . $category . '/price/asc') }} @elseif($category && $tag) {{ url('/category/' . $category . '/' . $tag->name . '/price/asc') }} @endif"

                                            class="checkbox" style="padding: 5px 9px; width: 100%;">
                                            <span class="checkbox__title">
                                                Цена 
                                                <svg fill="currentColor" preserveAspectRatio="xMidYMid meet" height="1em" viewBox="0 0 11 17" class="ogwO6 fwICw" style="vertical-align: middle;">
                                                    <g>
                                                        <polygon fill="
                                                                        @if (!empty($asc) && !empty($price))
                                                                                {!! '#000' !!}
                                                                            @else
                                                                                {!! '#B3B3B3' !!}
                                                                        @endif
                                                                    " 
                                                                    points="8.3,16.8 6.3,16.8 6.3,-0.6 11.2,4.3 9.7,5.7 8.3,4.3"></polygon>
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>

                                        <a href="@if ($category && !$tag) {{ url('/category/' . $category . '/price/desc') }} @elseif($category && $tag) {{ url('/category/' . $category . '/' . $tag->name . '/price/desc') }} @endif" 

                                            class="checkbox" style="padding: 5px 9px; width: 100%;">
                                            <span class="checkbox__title">
                                                Цена 
                                                <svg fill="currentColor" preserveAspectRatio="xMidYMid meet" height="1em" width="1em" viewBox="0 0 11 17" class="ogwO6 fwICw" style="vertical-align: middle;">
                                                    <g>
                                                        <polygon fill="
                                                                        @if (!empty($desc) && !empty($price))
                                                                                {!! '#000' !!}
                                                                            @else
                                                                                {!! '#B3B3B3' !!}
                                                                        @endif
                                                                    "
                                                        points="4.1,17.3 -0.7,12.5 0.7,11.1 2.1,12.5 2.1,0 4.1,0"></polygon>
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>


                                        <a href="@if ($category && !$tag) {{ url('/category/' . $category . '/name/asc') }} @elseif($category && $tag) {{ url('/category/' . $category . '/' . $tag->name . '/name/asc') }} @endif"

                                            class="checkbox" style="padding: 5px 9px; width: 100%;">
                                            <span class="checkbox__title">
                                                Имя 
                                                <svg fill="currentColor" preserveAspectRatio="xMidYMid meet" height="1em" viewBox="0 0 11 17" class="ogwO6 fwICw" style="vertical-align: middle;">
                                                    <g>
                                                        <polygon fill="
                                                                        @if (!empty($asc) && !empty($name))
                                                                                {!! '#000' !!}
                                                                            @else
                                                                                {!! '#B3B3B3' !!}
                                                                        @endif
                                                                    " 
                                                                    points="8.3,16.8 6.3,16.8 6.3,-0.6 11.2,4.3 9.7,5.7 8.3,4.3"></polygon>
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>

                                        <a href="@if ($category && !$tag) {{ url('/category/' . $category . '/name/desc') }} @elseif($category && $tag) {{ url('/category/' . $category . '/' . $tag->name . '/name/desc') }} @endif" 

                                            class="checkbox" style="padding: 5px 9px; width: 100%;">
                                            <span class="checkbox__title">
                                                Имя 
                                                <svg fill="currentColor" preserveAspectRatio="xMidYMid meet" height="1em" width="1em" viewBox="0 0 11 17" class="ogwO6 fwICw" style="vertical-align: middle;">
                                                    <g>
                                                        <polygon fill="
                                                                        @if (!empty($desc) && !empty($name))
                                                                                {!! '#000' !!}
                                                                            @else
                                                                                {!! '#B3B3B3' !!}
                                                                        @endif
                                                                    "
                                                        points="4.1,17.3 -0.7,12.5 0.7,11.1 2.1,12.5 2.1,0 4.1,0"></polygon>
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>

                                    </div><!--filter__block-content-->
                                </div>
                            </div><!--select-->

                        </div><!--sort-->

                    </div><!--catalog__panel-right-->

                </div><!--catalog__panel-->




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

                </div><!--catalog__list-->

                <div class="pages">
                    <a href="#" class="pages__link">1</a>
                    <span class="pages__link active">2</span>
                    <a href="#" class="pages__link">3</a>
                    <a href="#" class="pages__link">4</a>
                    <a href="#" class="pages__link">5</a>
                    <a href="#" class="pages__link">
                        <svg class="svg-icon icon-page-next"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-page-next"></use></svg>
                    </a>
                </div><!--pages-->

            </div><!--catalog__content-->

        </form><!--catalog-->

    </section><!--page-->
@endsection