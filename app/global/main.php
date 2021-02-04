<?php

use App\Slider;
use App\CategorySlider;


function slider($name, $blade = null)
{
	$slider_cat = CategorySlider::where('name', $name)->where('status', 'publish')->first();

	if (!empty($slider_cat))
		$slider = Slider::where('slider_id', $slider_cat->id)->get();
	
		if(!empty($slider) && $blade != null && view()->exists($blade))
			return view($blade)->with('items', $slider);
		else if (!empty($slider))
			return $slider;	
		else
			return false;
	
}


mb_internal_encoding("UTF-8");
function mb_ucfirst($text) 
{
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}


function _total_()
{
	$total = null;
    foreach (App\Cart::where('user_id', Session::get('id'))->get() as $cart) 
    {
        $total += $cart->cat_product->price * $cart->count;
    }
    Session::put('sum', $total);
    return $total;
}
