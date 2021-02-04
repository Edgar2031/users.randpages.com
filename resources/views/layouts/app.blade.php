<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset" content="{{ asset('/') }}">
    <meta name="currency" content="{{ setting('site.currency') }}">
    @if (Session::has('id'))
        <meta name="session" content="{!! Session::get('id') !!}">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>E-shop компьютеры и комплектующие</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('main_front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main_front/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main_front/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('main_front/css/style.css') }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <section class="page-wrap" id="page-wrap">
        @if (Session::has('id'))
                {{ menu('menu_top', 'layouts.menu_top') }}
                {{ menu('header', 'layouts.main_header') }}
            @else
                {{ menu('menu_top', 'layouts.logout_menu_top') }}
                {{ menu('header', 'layouts.logout_main_header') }}
        @endif

    	   @yield('content')

        {{ menu('footer', 'layouts.main_footer') }}
    </section>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;key=AIzaSyDOhWZWMNUSIYxWqcIni33voP8yTbnjNXs"></script>
	<script src="{{ asset('main_front/js/nouislider.min.js') }}"></script>
	<script src="{{ asset('main_front/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('main_front/js/script.js') }}"></script>
    <script src="{{ asset('main_front/js/main.js') }}"></script>
</body>
</html>

