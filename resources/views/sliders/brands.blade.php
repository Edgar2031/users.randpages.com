@if($items)

    <section class="brands">
        <div class="content">
            <div class="brands__slider">
                <ul class="brands__slides owl-carousel">

                	@foreach ($items as $slider_item)

	                    <li class="brand va-middle">
	                        <img src="{!! asset(Storage::disk(env( 'DISK', 'local'))->url($slider_item->image)) !!}" alt="{!! $slider_item->title !!}">
	                    </li>

	                @endforeach

                    {{-- <li class="brand va-middle">
                        <img src="images/brands/logo-2.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-3.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-4.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-5.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-1.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-2.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-3.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-4.png" alt="Лого">
                    </li>

                    <li class="brand va-middle">
                        <img src="images/brands/logo-5.png" alt="Лого">
                    </li> --}}

                </ul>

                <span class="brands__control-prev">
                    <svg class="svg-icon icon-brands-prev"><use xlink:href="{!! asset('main_front/images/sprite.svg') !!}#{!! setting('site.slider_prev_arrow') !!}"></use></svg>
                </span>

                <span class="brands__control-next">
                    <svg class="svg-icon icon-brands-next"><use xlink:href="{!! asset('main_front/images/sprite.svg') !!}#{!! setting('site.slider_next_arrow') !!}"></use></svg>
                </span>

            </div><!--brands__slider-->

        </div><!--content-->

    </section><!--brands-->

@endif