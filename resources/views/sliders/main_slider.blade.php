@if($items)



	<section class="main">
        <div class="main__slides owl-carousel">

            @foreach ($items as $slider_item)

                <div class="main__slide">
                    <div class="content">
                        <div class="main__slide-left">
                            <p class="main__slide-title">
                                {!! $slider_item->title !!}
                            </p>

                            <p class="main__slide-desc">
                                {!! $slider_item->info !!}
                            </p>

                            <a href="#" class="blue-btn main__slide-link">{!! $slider_item->button !!}</a>

                        </div><!--main__slide-left-->

                        <div class="main__slide-photo" id="main__slide_photo_id_{{ preg_replace('/\s+/', '_', $slider_item->title . $slider_item->id) }}">
                            <img src="{!! asset(Storage::disk(env( 'DISK', 'local'))->url($slider_item->image)) !!}" alt="{!! $slider_item->title !!}">
                        </div><!--main__slide-photo-->

                    {{--     <script type="text/javascript">
                            $('#main__slide_photo_id_{{ preg_replace('/\s+/', '_', $slider_item->title . $slider_item->id) }}:after')
                                .css('background', 'url({!! asset(Storage::disk(env( 'DISK', 'local'))->url($slider_item->fon_image)) !!})');
                        </script> --}}

                    </div><!--content-->
                    
                    <i class="main__slide-bg" style="background: url('{!! Voyager::Image($slider_item->background) !!}');"></i>

                </div><!--main__slide-->

            @endforeach
{{--      
            <div class="main__slide">
                <div class="content">
                    <div class="main__slide-left">
                        <p class="main__slide-title">
                            сборка компьютера
                        </p>

                        <p class="main__slide-desc">
                            мы поможем подобрать сборку по вашим параметрам
                        </p>

                        <a href="#" class="blue-btn main__slide-link">подробнее</a>

                    </div><!--main__slide-left-->

                    <div class="main__slide-photo">
                        <img src="images/main-slider/slide-1.png" alt="Слайд">
                    </div><!--main__slide-photo-->

                </div><!--content-->

                <i class="main__slide-bg"></i>

            </div><!--main__slide--> --}}

        </div><!--main__slides-->

        <div class="main__control content">
            <span class="main__control-prev">
                <svg class="svg-icon icon-slider-prev"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#{!! setting('site.slider_prev_arrow') !!}"></use></svg>
            </span>

            <span class="main__control-next">
                <svg class="svg-icon icon-slider-next"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#{!! setting('site.slider_next_arrow') !!}"></use></svg>
            </span>

        </div><!--main__control-->

    </section><!--main-->

@endif
