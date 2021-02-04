@extends('layouts.app')

@section('content')


    <section class="page content">
        <div class="pager">
            <a href="{{ url('/') }}">Главная</a>
            <i>/</i>
            <span>Сравнение товаров</span>
        </div><!--pager-->

        <div class="diff">
            <div class="diff__list flex-container">

                @foreach ($products as $item_product)
                    
                    <div class="diff__item">
                        <a href="{!! url('/item_product_view/' . $item_product->comparison_product->id) !!}" class="diff__item-photo">
                            @php
                                if(json_decode($item_product->comparison_product->photo) && !empty(json_decode($item_product->comparison_product->photo)))
                                    $photo = json_decode($item_product->comparison_product->photo)[0];
                                else
                                    $photo = null;
                            @endphp
                            <img src="  @if ($photo != null && !empty($photo))
                                            {{ asset('/storage/' . $photo) }}
                                        @endif" alt="{!! $item_product->comparison_product->name !!}">
                        </a><!--diff__item-photo-->

                        <div class="diff__item-top" data-value="{!! $item_product->comparison_product->id !!}">
                            <a href="{!! url('/item_product_view/' . $item_product->comparison_product->id) !!}" class="diff__item-link">{!! $item_product->comparison_product->name !!}</a>
                            <p class="diff__item-price">{!! $item_product->comparison_product->price . ' ' . setting('site.currency') !!}</p>
                            <span class="diff__item-delete delete_of_comparison">
                                <svg class="svg-icon icon-delete "><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-delete"></use></svg>
                            </span>
                        </div><!--diff__item-top-->

                        {!! $item_product->comparison_product->comparison_description ?? '' !!}

                        {{-- <ul class='diff__item-params'>
                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>Диагональ экрана</p>
                                <p class='diff__item-param-desc'>15.6'</p>
                            </li>

                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>разрешение экрана</p>
                                <p class='diff__item-param-desc'>1366 x 768</p>
                            </li>

                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>видеокарта</p>
                                <p class='diff__item-param-desc'>Radeon HD 8570M</p>
                            </li>

                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>процессор</p>
                                <p class='diff__item-param-desc'>A10-5750M</p>
                            </li>

                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>оперативная память</p>
                                <p class='diff__item-param-desc'>4 ГБ DDR3L</p>
                            </li>

                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>жесткий диск</p>
                                <p class='diff__item-param-desc'>1 ТБ HDD</p>
                            </li>

                            <li class='diff__item-param'>
                                <p class='diff__item-param-title'>ТВЕРДОТЕЛЬНЫЙ НАКОПИТЕЛЬ</p>
                                <p class='diff__item-param-desc'>Отсутствует</p>
                            </li>

                        </ul> --}}

                    </div><!--diff__item-->

                @endforeach

               {{--  <div class="diff__item">
                    <a href="#" class="diff__item-photo">
                        <img src="images/products/product-2/basket-preview.png" alt="Ноутбук Lenovo G505s">
                    </a><!--diff__item-photo-->

                    <div class="diff__item-top">
                        <a href="#" class="diff__item-link">Нетбук Lenovo Slim 1-11AST-05</a>
                        <p class="diff__item-price">220 800 ₸</p>
                        <span class="diff__item-delete">
                            <svg class="svg-icon icon-delete"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-delete"></use></svg>
                        </span>
                    </div><!--diff__item-top-->

                    <ul class="diff__item-params">
                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">11"</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">1366 x 768</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">Radeon R3</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">AMD 9120e</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">4 ГБ DDR4</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">Отсутствует</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">64 ГБ SSD</p>
                        </li>

                    </ul>

                </div><!--diff__item-->

                <div class="diff__item">
                    <a href="#" class="diff__item-photo">
                        <img src="images/products/product-3/basket-preview.png" alt="Ноутбук Lenovo G505s">
                    </a><!--diff__item-photo-->

                    <div class="diff__item-top">
                        <a href="#" class="diff__item-link">Нетбук Lenovo Slim 1-11AST-05</a>
                        <p class="diff__item-price">220 800 ₸</p>
                        <span class="diff__item-delete">
                            <svg class="svg-icon icon-delete"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-delete"></use></svg>
                        </span>
                    </div><!--diff__item-top-->

                    <ul class="diff__item-params">
                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">11"</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">1366 x 768</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">Radeon R3</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">AMD 9120e</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">4 ГБ DDR4</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">Отсутствует</p>
                        </li>

                        <li class="diff__item-param">
                            <p class="diff__item-param-desc">64 ГБ SSD</p>
                        </li>

                    </ul>

                </div><!--diff__item-->
 --}}
            </div><!--diff__list-->

        </div><!--diff-->

    </section><!--page-->


@endsection


    