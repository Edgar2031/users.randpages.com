<script type="text/javascript">
    swal({
        title: "",
        text: "Товар удалено из список желаний",
        icon: "success",
        button: "Продолжить покупки",
    });

    $('.nav-bar__link-count').html({!! App\Cart::where('user_id', Session::get('id'))->count() !!})
    $('.wishlist_count').html({!! App\Wishlist::where('user_id', Session::get('id'))->count() !!})
    $('.comparison_count').html({!! App\Comparison::where('user_id', Session::get('id'))->count() !!})
</script>