@extends('layouts.app')

@section('content')

    <section class="page content">
        <div class="pager">
            <a href="#">Главная</a>
            <i>/</i>
            <a href="#">Личный кабинет</a>
            <i>/</i>
            <span>мой профиль</span>
        </div><!--pager-->

        <div class="personal spacer_top">
            <aside class="personal__aside">
                <div class="personal__links">
                    <a href="{{ url('/personal_area') }}" class="personal__link">
                        <svg class="svg-icon icon-personal-link-1"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-1"></use></svg>
                        <span>Мой профиль</span>
                    </a>

                    <a href="{{ url('/order_history') }}" class="personal__link">
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
                <form action="{{ url('/log_in') }}" method="post">
                    {{ csrf_field() }}

                    <div class="personal__data-fields spacer_top">

                        <label class="form__label">
                            <span class="form__label-title">Логин</span>
                            <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('email') !!}</span>
                            
                            <input type="email" name="email" class="form__field" value="{{ old('email') }}" placeholder="Укажите e-mail">
                        </label>

                        <label class="form__label">
                            <span class="form__label-title">Пароль</span>
                            <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('password') !!}</span>
                            
                            <input type="password" name="password" class="form__field" value="{{ old('password') }}" placeholder="Укажите пароль">
                        </label>

                    </div><!--personal__data-fields-->

                    <button class="yellow-btn form__btn" style="max-width: 100px;">Вход</button>
                    <a href="{{ url('/sign_up') }}" class="yellow-btn form__btn" style="background: #3ecc11; max-width: 150px; float: right;">Регистрация</a>
                </form>

            </div><!--personal__content-->

        </div><!--personal-->

    </section><!--page-->
@endsection
    