<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Cart;
use App\Product;
use App\ProductImage;


class CartController extends Controller
{
    // <= ======================== Cart page ======================== =>
    public function cart()
    {
        $products = Cart::where('user_id', Session::get('id'))->get();
    	return view('basket', compact('products'));
    }



    // <= ======================== Add product to cart ======================== =>
    public function product_item_add_to_cart(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $cart = Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (empty($cart)) 
            {
                $add_to_cart = new Cart();
                $add_to_cart->user_id = Session::get('id');
                $add_to_cart->product_id = $request->id;
                // $add_to_cart->count = $request->count;
                $add_to_cart->save();

                $product = Product::where('id', $request->id)->first();
                return View::make('modal.product_add_to_cart', compact('product'));   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    	
    }


    // <= ======================== Remove product of cart ======================== =>
    public function product_item_remove_of_cart(Request $request) 
    {
        if (!empty($request) && Session::has('id')) 
        {
            $cart = Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (!empty($cart)) 
            {
                Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->delete();
                return View::make('message.cart_success');   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    }



    // <= ======================== Item product plus count of cart ======================== =>
    public function item_product_plus_count_of_cart(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $cart    = Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            $product = Product::where('id', $request->id)->first();
            if (!empty($cart) && (int)$cart->count < (int)$product->count) 
            {
                Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->update(array('count' => (int)$cart->count + 1));
                $total = null;
                foreach (Cart::where('user_id', Session::get('id'))->get() as $cart) 
                {
                    $total += $cart->cat_product->price * $cart->count;
                }
                return json_encode(array(
                                    'count' => (int)Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first()->count, 
                                    'price' => $product->price * (int)$cart->count + 1, 
                                    'total' => $total
                                ));   
            }
        }
        // else
        //     return json_encode('<script type="text/javascript">location.href = \'/sign_in\'</script>');
    }


    // <= ======================== Item product minus count of cart ======================== =>
    public function item_product_minus_count_of_cart(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $cart    = Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            $product = Product::where('id', $request->id)->first();
            if (!empty($cart) && (int)$cart->count < (int)$product->count && (int)$cart->count > 1) 
            {
                Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->update(array('count' => (int)$cart->count - 1));
                $total = null;
                foreach (Cart::where('user_id', Session::get('id'))->get() as $cart) 
                {
                    $total += $cart->cat_product->price * $cart->count;
                }
                return json_encode(array(
                                    'count' => (int)Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first()->count, 
                                    'price' => $product->price * (int)Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first()->count, 
                                    'total' => $total
                                ));   
            }
        }
    }



}
