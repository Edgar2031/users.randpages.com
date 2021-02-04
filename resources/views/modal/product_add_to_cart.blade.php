<div class="overlay" id="product_model">
    <div class="popup popup-add">
        <span class="popup__close model_close">
            <svg class="svg-icon icon-close"><use xlink:href="{{ asset('main_front/images/sprite.svg') }}#icon-close"></use></svg>
        </span>

        <p class="popup__title">
            Товар добавлен в корзину!
        </p>

        <div class="popup-add__product spacer_top">
            <div class="popup-add__photo">
                @php
                    $m_photo = json_decode($product->photo)[0];
                @endphp
                <img class="pos-center" src="{{ asset('/storage/' . $m_photo) }}" alt="Ноутбук Lenovo G505s">
            </div><!--popup-add__photo-->

            <div class="popup-add__right">
                <p class="popup-add__title">
                    {!! $product->name !!}
                </p>

                <p class="popup-add__price">
                    {!! $product->price . ' ' . setting('site.currency') !!}
                </p>

                <p class="popup-add__count">
                    Количество: 1 шт
                </p>

            </div><!--popup-add__right-->

        </div><!--popup-add__product-->

        <div class="popup-add__btns spacer">
            <a class="popup-add__return model_close">Продолжить покупки</a>
            <a href="{{ url('/cart') }}" class="yellow-btn popup-add__link">Перейти в корзину</a>
        </div><!--popup-add__btns-->

    </div><!--popup-->
</div>

<script type="text/javascript">
    $('.nav-bar__link-count').html({!! App\Cart::where('user_id', Session::get('id'))->count() !!})
    $('.wishlist_count').html({!! App\Wishlist::where('user_id', Session::get('id'))->count() !!})
    $('.comparison_count').html({!! App\Comparison::where('user_id', Session::get('id'))->count() !!})
</script>