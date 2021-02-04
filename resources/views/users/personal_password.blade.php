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
                    <span>Смена пароля</span>
                </div><!--pager-->

                <div class="personal spacer_top">
                    <aside class="personal__aside">
                        <div class="personal__links">
                            <a href="{{ url('/personal_area') }}" class="personal__link">
                                <svg class="svg-icon icon-personal-link-1"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-1"></use></svg>
                                <span>Мой профиль</span>
                            </a>

                            <a href="{{ url('/personal_history') }}" class="personal__link">
                                <svg class="svg-icon icon-personal-link-2"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-2"></use></svg>
                                <span>История заказов</span>
                            </a>

                            <a href="{{ url('/personal_password') }}" class="personal__link active">
                                <svg class="svg-icon icon-personal-link-3"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-personal-link-3"></use></svg>
                                <span>Смена пароля</span>
                            </a>

                        </div><!--personal__links-->

                    </aside>

                    <div class="personal__content">
                        <form action="{{ url('/repeat_password') }}" method="post">
                            {{ csrf_field() }}

                            <label class="form__label">
                                <span class="form__label-title">Старый пароль</span>
                                <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('old_password') !!}</span>
                                <input type="password" name="old_password" class="form__field" value="{{ old('old_password') }}" placeholder="Введите пароль" style="width: 40%;">
                            </label>

                            <label class="form__label">
                                <span class="form__label-title">Новый пароль</span>
                                <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('new_password') !!}</span>
                                <input type="password" name="new_password" class="form__field" value="{{ old('new_password') }}" placeholder="Введите пароль" style="width: 40%;">
                            </label>

                            <label class="form__label">
                                <span class="form__label-title">Повторите пароль</span>
                                <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('repeat_password') !!}</span>
                                <input type="password" name="repeat_password" class="form__field" value="{{ old('repeat_password') }}" placeholder="Введите пароль" style="width: 40%;">
                            </label>

                            <button class="yellow-btn form__btn">Сохранить</button>

                        </form>

                    </div><!--personal__content-->

                </div><!--personal-->

            </section><!--page-->
    @endif
@endsection