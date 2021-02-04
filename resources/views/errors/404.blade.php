@extends('layouts.app')

@section('content')

	<section class="page content">
        <div class="error">
            <i class="error__number"></i>
            <p class="error__title">
                Упс... Похоже мы не можем найти нужную вам страницу
            </p>

            <p class="error__code">
                Код ошибки: 404
            </p>

            <a href="{{ url('/') }}" class="yellow-btn error__return">Вернуться на главную</a>

        </div><!--error-->

    </section><!--page-->

@endsection