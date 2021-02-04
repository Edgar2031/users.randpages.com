$(function() {
	let $session  = $('meta[name="session"]').attr('content')
	let $asset    = $('meta[name="asset"]').attr('content')
	let $currency = $('meta[name="currency"]').attr('content')


	$(document).on('click', '.model_close', function(event) {
		$('#product_model').remove()
	});


	$(document).on('click', '.p_item_add', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_add_to_cart', {id})
				.done(function($data) {
					$($this).after(`<button class="catalog__item-add p_item_remove" style="margin-top: 0;">Убрать из корзины</button>`);
					$($this).remove()
			    	$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});

	$(document).on('click', '.p_item_remove', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_remove_of_cart', {id})
				.done(function($data) {
					$($this).after(`<button class="catalog__item-add p_item_add" style="margin-top: 0;">Добавить в корзину</button>`);
					$($this).remove()
			    	$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});


	$(document).on('click', '.cart_p_item_remove', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_remove_of_cart', {id})
				.done(function($data) {
					$($this).parent().parent().remove()
					$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});



	$(document).on('click', '.wishlist_p_item_add', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_add_to_wishlist', {id})
				.done(function($data) {
					$($this).after(`<a class="catalog__item-link wishlist_p_item_add"><svg class="svg-icon icon-product-favorite"><use fill="#F2C94C" xlink:href="${$asset}main_front/images/sprite.svg#icon-product-favorite"></use></svg></a>`);
					$($this).remove()
			    	$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});

	$(document).on('click', '.wishlist_p_item_remove', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_remove_of_wishlist', {id})
				.done(function($data) {
					$($this).after(`<a class="catalog__item-link wishlist_p_item_add"><svg class="svg-icon icon-product-favorite"><use xlink:href="${$asset}main_front/images/sprite.svg#icon-product-favorite"></use></svg></a>`);
					$($this).remove()
			    	$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});

	
	$(document).on('click', '.wish_p_item_add', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_add_to_cart_of_wishlist', {id})
				.done(function($data) {
					$($this).parent().parent().parent().remove()
					$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});	


	$(document).on('click', '.wish_p_item_remove', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_remove_of_wishlist', {id})
				.done(function($data) {
					$($this).parent().parent().parent().remove()
					$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});


	$(document).on('click', '.comparison_p_item_add', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_add_to_comparison', {id})
				.done(function($data) {
					$($this).after(`<a class="catalog__item-link comparison_p_item_remove"><svg class="svg-icon icon-product-diff"><use fill="#F2C94C" xlink:href="${$asset}main_front/images/sprite.svg#icon-product-diff"></use></svg></a>`);
					$($this).remove()
			    	$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});

	$(document).on('click', '.comparison_p_item_remove', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_remove_of_comparison', {id})
				.done(function($data) {
					$($this).after(`<a class="catalog__item-link comparison_p_item_add"><svg class="svg-icon icon-product-diff"><use xlink:href="${$asset}main_front/images/sprite.svg#icon-product-diff"></use></svg></a>`);
					$($this).remove()
			    	$('#page-wrap').append($data)
			  	});
		else
			location.href = '/sign_in';
	});


	$(document).on('click', '.g_star', function(event) {
		let id = $(this).parent().attr('data-value');
		let star = $(this).val();
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/product_item_add_star', {id, star})
				.done(function($data) {
					$('#product_rating_' + id).html($data)
			  	});
		else
			location.href = '/sign_in';
	});


	// cart product plus and minus

	$(document).on('click', '.count__minus', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			if (Number($('#count__length_' + id).html()) > 1 && Number($('#count__length_' + id).html()) < Number($(this).parent().attr('data-count-product'))) 
			{
				$.post('/item_product_minus_count_of_cart', {id})
					.done(function($data) {
						$data = JSON.parse($data)
						$('#count__length_' + id).html($data.count)
						$('#count__price_' + id).html($data.price + " " + $currency)
						$('#products_total').html($data.total)
				  	});
			}
	});


	$(document).on('click', '.count__plus', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			if (Number($('#count__length_' + id).html()) >= 1 && Number($('#count__length_' + id).html()) < Number($(this).parent().attr('data-count-product'))) 
			{
				$.post('/item_product_plus_count_of_cart', {id})
					.done(function($data) {
						$data = JSON.parse($data)
						$('#count__length_' + id).html($data.count)
						$('#count__price_' + id).html($data.price + " " + $currency)
						$('#products_total').html($data.total)
				  	});
			}
	});



	$(document).on('click', '.delete_of_comparison', function(event) {
		let id = $(this).parent().attr('data-value');
		let $this = $(this)
		if ($session != undefined && $session != null && $session.length > 0)
			$.post('/item_product_delete_of_comparison', {id})
				.done(function($data) {
					$('#page-wrap').append($data)
					$($this).parent().parent().remove()
			  	});
		else
			location.href = '/sign_in';
	});




	// Search
	$('.search_icon').click(function(event) {
		if ($('.search_show').length > 0) 
		{
			$(this).parent().find('input').animate({paddingLeft : '0', width : '0'},  1000).removeClass('search_show')
		}
		else
		{
			$(this).parent().find('input').animate({paddingLeft : '10px', width : '145px'},  1000).addClass('search_show')
		}
	});

    $(document).on('keypress', '.search_show', function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13')
        {
            alert('You pressed a "enter" key in textbox');  
        }
    });



});