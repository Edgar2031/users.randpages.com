$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var mainSlider = $('.main__slides').owlCarousel({
        smartSpeed: 900,
        loop:true,
        mouseDrag: true,
        items: 1
    });

    $('.main__control-next').click(function() {
        mainSlider.trigger('next.owl.carousel');
    });

    $('.main__control-prev').click(function() {
        mainSlider.trigger('prev.owl.carousel');
    });

    var brandsSlider = $('.brands__slides').owlCarousel({
        margin:70,
        loop:true,
        autoWidth:true,
        items:5,
        responsive:{
            0:{
                autoWidth:false,
                margin:30,
                items:2
            },
            500:{
                autoWidth:false,
                margin:30,
                items:3
            },
            1024:{
                autoWidth:false,
                items:4
            },
            1300:{
                items:5
            }
        }
    });

    $('.brands__control-next').click(function() {
        brandsSlider.trigger('next.owl.carousel');
    });

    $('.brands__control-prev').click(function() {
        brandsSlider.trigger('prev.owl.carousel');
    });

    var productSlider = $('.product__slides').owlCarousel({
        loop:false,
        items:1
    });

    productSlider.on('translated.owl.carousel', function (e) {
        $('.product__preview').removeClass('active');
        $('.product__preview' + '[data-index= ' + $('.product__slides .owl-item.active').find('.product__slide').data('index') + ']').addClass('active');
    });

    var productPreviews = $('.product__previews-slides').owlCarousel({
        margin:4,
        loop:false,
        items:4
    });

    $('.product__previews-next').click(function() {
        productPreviews.trigger('next.owl.carousel');
    });

    $('.product__previews-prev').click(function() {
        productPreviews.trigger('prev.owl.carousel');
    });

    $('.product__previews').on('click', '.product__preview', function() {
        $('.product__preview').removeClass('active');
        $(this).addClass('active');
        productSlider.trigger('to.owl.carousel', $(this).data('index'));
    });

    $('.catalog__item').hover(function() {
        $(this).prev().addClass('prevHover');
    }, function () {
        $(this).prev().removeClass('prevHover');
    });

    $('.menu__nav').on('click', function() {
        if($(this).hasClass('open')) {
            $('.page-wrap').css('overflow', 'hidden');
            $('html').css('overflow', 'auto');
            $(this).removeClass('open');
            $('.nav').slideUp();
        } else {
            $('html').height($(window).height()).css('overflow', 'hidden');
            $('.page-wrap').css('overflow', 'scroll');
            $(this).addClass('open');
            $('.nav').slideDown();
        }
    });

    $('.filter__block-title').on('click', function() {
        var block = $(this).parent();
        if(block.hasClass('open')) {
            block.removeClass('open').find('.filter__block-content').slideUp();
        } else {
            block.addClass('open').find('.filter__block-content').slideDown();
        }
    });

    $('.filter__btn').on('click', function() {
        if($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('.filter__content').slideUp();
        } else {
            $(this).addClass('open');
            $('.filter__content').slideDown();
        }
    });

    $('.tabs__link').on('click', function(e) {
        e.preventDefault();
        $('.tabs__link').removeClass('active');
        $(this).addClass('active');
        $('.tab').removeClass('active').eq($(this).index()).addClass('active');
        $(window).trigger('scroll');
    });

    if($('.product__right').index() != -1) {
        var productRightTop = $('.product__right').offset().top;
        $(window).scroll(function(){
            var top = $(this).scrollTop();

            if (top > productRightTop && top < productRightTop + $('.product__right').height() - $('.product__slider').height()) {
                $('.product__slider').css('top', top - productRightTop);
            } else if (top < productRightTop){
                $('.product__slider').css('top', '0');
            } else {
                $('.product__slider').css('top', productRightTop + $('.product__right').height() - $('.product__slider').height() * 1.5);
            }
        });

        $(window).trigger('scroll');
    }

    var scalePrice = document.getElementById('scaleLine');
    var scaleFrom = document.getElementById('scaleFrom');
    var scaleTo = document.getElementById('scaleTo');

    noUiSlider.create(scalePrice, {
        start: [150000, 2000000],
        connect: true,
        range: {
            'min': 150000,
            'max': 2000000
        },
        format: wNumb({
            decimals: 0,
            thousand: ' '
        })
    });
    scalePrice.noUiSlider.on('update', function (values, handle) {
        if (handle) {
            scaleTo.value = values[handle];
        } else {
            scaleFrom.value = values[handle];
        }
    });

    scaleFrom.addEventListener('change', function () {
        scalePrice.noUiSlider.set([this.value, null]);
    });

    scaleTo.addEventListener('change', function () {
        scalePrice.noUiSlider.set([null, this.value]);
    });
});

function initMainMap() {
    // Create a map object and specify the DOM element for display.
    var position = {lat: 43.237893, lng: 76.885618};

    var map = new google.maps.Map(document.getElementById('map'), {
        center: position,
        zoom: 16,
        scrollwheel: false,
        panControl: false,
        scaleControl: false,
        mapTypeControl: false,
        streetViewControl: false
    });

    var marker = new google.maps.Marker({
        position: {lat: 43.237893, lng: 76.885618},
        map: map,
        title: 'Абая проспект, 138/2 3 этаж; 4 офис Бостандыкский район, Алматы'
    });

}

if($('#map').index() != -1) {
    initMainMap();
}

