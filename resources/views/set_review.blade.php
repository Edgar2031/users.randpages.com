@extends('layouts.app')

@section('content')

	<section class="page content">
        <div class="pager">
            <a href="{{ url('/') }}">Главная</a>
            <i>/</i>
            <a href="{{ url('/category/' . preg_replace('/\s+/', '_', $category->name)) }}">Каталог</a>
            <i>/</i>
            <a href="{{ url('/category/' . preg_replace('/\s+/', '_', $category->name)) }}">{!! $category->name !!}</a>
            <i>/</i>
            <a href="{{ url('/item_product_view/' . $item_product->id) }}">{!! $item_product->name !!}</a>
            <i>/</i>
            <span>Мой отзыв {!! $item_product->name !!}</span>
        </div><!--pager-->

        <form action="{{ url('/add_review/' . $item_product->id) }}" method="post" class="set-review">
            {{ csrf_field() }}
            <h1>
                {!! $item_product->name !!}
            </h1>

            <div class="set-review__rating">
                <p class="set-review__rating-title">
                    Общая оценка:
                </p>
                <p class="set-review__rating-title" style="color: #132f509c;">{!! $errors->first('star') !!}</p>

                <div class="star-rating" style="display: flex;">
                    <fieldset data-value="{!! $item_product->id !!}">
                     	<input type="hidden" name="star" value="">

        	            @for ($i = 5; $i > 0; $i--)
                            <input type="radio" id="star{{ $i }}" class="g_star" name="star" value="{{ $i }}">
                            <label for="star{{ $i }}" title="{{ $i }}">{{ $i }} stars</label>
                        @endfor

                    </fieldset>
                </div>
                {{-- <div class="set-review__rating-list">
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                    <svg class="svg-icon icon-star active"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                    <svg class="svg-icon icon-star"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-star"></use></svg>
                </div><!--set-review__rating-list--> --}}

            </div><!--set-review__rating-->

            <div class="set-review__form">

                <div class="form__label">
                    <p class="form__label-title">Срок использования:</p>
                    <p class="form__label-title" style="color: #132f509c;">{!! $errors->first('term_use') !!}</p>
                    <input type="hidden" name="term_use" value="">
                    <div class="checkboxes">
                        <label class="checkbox">
                            <input type="radio" name="term_use" value="Менее месяца">
                            <span class="checkbox__btn">
                                <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                            </span>
                            <span class="checkbox__title">Менее месяца</span>
                        </label>

                        <label class="checkbox">
                            <input type="radio" name="term_use" value="Полгода">
                            <span class="checkbox__btn">
                                <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                            </span>
                            <span class="checkbox__title">Полгода</span>
                        </label>

                        <label class="checkbox">
                            <input type="radio" name="term_use" value="Более года">
                            <span class="checkbox__btn">
                                <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                            </span>
                            <span class="checkbox__title">Более года</span>
                        </label>

                    </div><!--checkboxes-->

                </div><!--form__label-->

                <label class="form__label">
                    <span class="form__label-title">Достоинства:</span>
                    <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('dignity') !!}</span>
                    <textarea name="dignity" class="form__field form__field_text" placeholder="Укажите достоинства товара">{{ old('dignity') }}</textarea>
                </label>

                <label class="form__label">
                    <span class="form__label-title">Недостатки:</span>
                    <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('disadvantages') !!}</span>
                    <textarea name="disadvantages" class="form__field form__field_text" placeholder="Укажите недостатки товара">{{ old('disadvantages') }}</textarea>
                </label>

                <label class="form__label">
                    <span class="form__label-title">Комментарии:</span>
                    <span class="form__label-title" style="color: #132f509c;">{!! $errors->first('comment') !!}</span>
                    <textarea name="comment" class="form__field form__field_comment form__field_text" placeholder="Добавьте комментарий">{{ old('comment') }}</textarea>
                </label>

                <div class="set-review__form-btns spacer">
                    <a href="{!! Redirect::back()->getTargetUrl() !!}" class="white-btn set-review__cancel">отменить</a>
                    <button class="yellow-btn set-review__send" >Отправить</button>
                </div><!--set-review__form-btns-->

{{--                 <label class="privacy">
                    <input type="checkbox">
                    <span class="checkbox__btn">
                        <svg class="svg-icon icon-check pos-center"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-check"></use></svg>
                    </span>
                    <span class="privacy__desc">
                        Нажимая кнопку “Отправить”, Вы соглашаетесь
                        с условиями <a href="#">Политики конфиденциальности</a>
                    </span>
                </label> --}}

            </div>

        </form><!--set-review-->

    </section><!--page-->

@endsection
