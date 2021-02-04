@extends('layouts.app')

@section('content')
    @if (empty(Session::get('id')))
            @php
                header("Location: " . URL::to('/sign_in'), true, 302);
                exit();
            @endphp
        @else
            <section class="page content">
                <div class="pager">
                    <a href="#">Главная</a>
                    <i>/</i>
                    <a href="#">Личный кабинет</a>
                    <i>/</i>
                    <span>История заказов</span>
                </div><!--pager-->

                <div class="personal spacer_top">
                    <aside class="personal__aside">
                        <div class="personal__links">
                            <a href="{{ url('/personal_area') }}" class="personal__link">
                                <svg class="svg-icon icon-personal-link-1"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-1"></use></svg>
                                <span>Мой профиль</span>
                            </a>

                            <a href="{{ url('/personal_history') }}" class="personal__link active">
                                <svg class="svg-icon icon-personal-link-2"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-2"></use></svg>
                                <span>История заказов</span>
                            </a>

                            <a href="{{ url('/personal_password') }}" class="personal__link">
                                <svg class="svg-icon icon-personal-link-3"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-3"></use></svg>
                                <span>Смена пароля</span>
                            </a>

                        </div><!--personal__links-->

                    </aside>

                    <div class="personal__content">
                        <div class="orders">
                            <div class="orders__item">
                                <div class="orders__item-top spacer_top">
                                    <span class="orders__item-index">№ 123554</span>
                                    <span class="orders__item-date">18.09.2020  12:59</span>
                                </div><!--orders__item-top-->

                                <div class="orders__item-info">
                                    <div class="orders__item-col">
                                        <a href="#" class="orders__item-link">Ноутбук Lenovo G505s</a>
                                        <p class="orders__item-param">
                                            Код товара: <strong>1294625900</strong>
                                        </p>

                                        <p class="orders__item-param">
                                            Цвет: <strong>Черный</strong>
                                        </p>

                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">1 шт</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">147 500 {{ setting('site.currency') }} </span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status done">Доставлен</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status done">Оплачен</span>
                                    </div><!--orders__item-col-->

                                </div><!--orders__item-info-->

                            </div><!--orders__item-->

                            <div class="orders__item">
                                <div class="orders__item-top spacer_top">
                                    <span class="orders__item-index">№ 123554</span>
                                    <span class="orders__item-date">18.09.2020  12:59</span>
                                </div><!--orders__item-top-->

                                <div class="orders__item-info">
                                    <div class="orders__item-col">
                                        <a href="#" class="orders__item-link">Ноутбук Lenovo G505s</a>
                                        <p class="orders__item-param">
                                            Код товара: <strong>1294625900</strong>
                                        </p>

                                        <p class="orders__item-param">
                                            Цвет: <strong>Черный</strong>
                                        </p>

                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">1 шт</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">147 500 {{ setting('site.currency') }} </span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status">Не доставлен</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status">Не оплачен</span>
                                    </div><!--orders__item-col-->

                                </div><!--orders__item-info-->

                            </div><!--orders__item-->

                            <div class="orders__item">
                                <div class="orders__item-top spacer_top">
                                    <span class="orders__item-index">№ 123554</span>
                                    <span class="orders__item-date">18.09.2020  12:59</span>
                                </div><!--orders__item-top-->

                                <div class="orders__item-info">
                                    <div class="orders__item-col">
                                        <a href="#" class="orders__item-link">Ноутбук Lenovo G505s</a>
                                        <p class="orders__item-param">
                                            Код товара: <strong>1294625900</strong>
                                        </p>

                                        <p class="orders__item-param">
                                            Цвет: <strong>Черный</strong>
                                        </p>

                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">1 шт</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">147 500 {{ setting('site.currency') }} </span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status done">Доставлен</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status done">Оплачен</span>
                                    </div><!--orders__item-col-->

                                </div><!--orders__item-info-->

                            </div><!--orders__item-->

                            <div class="orders__item">
                                <div class="orders__item-top spacer_top">
                                    <span class="orders__item-index">№ 123554</span>
                                    <span class="orders__item-date">18.09.2020  12:59</span>
                                </div><!--orders__item-top-->

                                <div class="orders__item-info">
                                    <div class="orders__item-col">
                                        <a href="#" class="orders__item-link">Ноутбук Lenovo G505s</a>
                                        <p class="orders__item-param">
                                            Код товара: <strong>1294625900</strong>
                                        </p>

                                        <p class="orders__item-param">
                                            Цвет: <strong>Черный</strong>
                                        </p>

                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">1 шт</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-desc">147 500 {{ setting('site.currency') }} </span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status">Не доставлен</span>
                                    </div><!--orders__item-col-->

                                    <div class="orders__item-col">
                                        <span class="orders__item-status">Не оплачен</span>
                                    </div><!--orders__item-col-->

                                </div><!--orders__item-info-->

                            </div><!--orders__item-->

                        </div><!--orders-->

                    </div><!--personal__content-->

                </div><!--personal-->

            </section><!--page-->
    @endif
@endsection
    