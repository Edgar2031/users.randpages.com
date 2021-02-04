@extends('layouts.app')

@section('content')

    <section class="page content">
        <div class="pager">
            <a href="{{ url('/') }}">Главная</a>
            <i>/</i>
            <span>корзина</span>
        </div><!--pager-->

        <div class="basket">
            <div class="basket__table">
                @if (@count($products) > 0)

                        <div class="basket__table-header">
                            <div class="basket__table-col">
                                Товар
                            </div><!--basket__table-col-->

                            <div class="basket__table-col">
                                Доступность
                            </div><!--basket__table-col-->

                            <div class="basket__table-col">
                                Количество
                            </div><!--basket__table-col-->

                            <div class="basket__table-col">
                                Цена
                            </div><!--basket__table-col-->

                            <div class="basket__table-col">
                                Удалить
                            </div><!--basket__table-col-->

                        </div><!--basket__table-header-->

                        @foreach ($products as $cat)
                            @php
                                $photo = json_decode($cat->cat_product->photo)[0];
                            @endphp

                            <div class="basket__item">
                                <div class="basket__table-col">
                                    <div class="basket__item-photo">
                                        <img class="pos-center" src="{{ asset('/storage/' . $photo) }}" alt="Ноутбук Lenovo G505s">
                                    </div><!--basket__item-photo-->

                                    <div class="basket__item-info">
                                        <p class="basket__item-title">
                                            {{ $cat->cat_product->name }}
                                        </p>

                                        <p class="basket__item-param">
                                            Код товара: <strong> {{$cat->code}}</strong>
                                        </p>

                                        <a href="{{ url('/item_product_view/' . $cat->cat_product->id) }}" class="basket__item-link">Перейти к товару</a>

                                    </div><!--basket__item-info-->

                                </div><!--basket__table-col-->

                                <div class="basket__table-col">
                                    <p class="basket__item-status">
                                        {{ $cat->cat_product->availability }}
                                    </p>

                                </div><!--basket__table-col-->

                                <div class="basket__table-col">
                                    <div class="count" data-value="{{ $cat->cat_product->id }}" data-count-product="{{ $cat->cat_product->count }}">
                                        <span class="count__minus"></span>
                                        <span class="count__length" id="count__length_{{ $cat->cat_product->id }}">{{ $cat->count }}</span>
                                        <span class="count__plus"></span>
                                    </div><!--count-->

                                </div><!--basket__table-col-->

                                <div class="basket__table-col">
                                    <p class="basket__item-price">
                                       <span id="count__price_{{ $cat->cat_product->id }}">{{ $cat->cat_product->price * $cat->count . ' ' . setting('site.currency') }}</span>
                                    </p>

                                    <span class="basket__item-delete">
                                        <svg class="svg-icon icon-delete"><use xlink:href="images/sprite.svg#icon-delete"></use></svg>
                                    </span>

                                </div><!--basket__table-col-->

                                <div class="basket__table-col" data-value="{{ $cat->cat_product->id }}">
                                    <span class="favorite__delete cart_p_item_remove">
                                        <svg class="svg-icon icon-delete"><use xlink:href="{{ asset('/main_front/images/sprite.svg') }}#icon-delete"></use></svg>
                                    </span>
                                </div>

                            </div><!--basket__item-->

                        @endforeach

                    @else

                        <div class="basket__item">
                            <div class="basket__table-col" style="width: 100%; padding: 20px; text-align: center;">
                                Корзина пустой
                            </div><!--basket__table-col-->
                        </div>

                @endif


            <div class="basket__result">
                <p class="basket__result-sum">
                    Итого: <strong>
                                <span id="products_total">
                                    {!! _total_() !!}
                                </span> 
                                {{ setting('site.currency') }}
                            </strong>
                </p>

                <button class="yellow-btn basket__btn" 
                        onclick="
                                {{ _total_() }}
                                location.href = '{{ url('pay_stripe') }}' ">
                            Оформить заказ
                </button>

            </div><!--basket-->

        </div><!--basket-->

    </section><!--page-->



   
@endsection