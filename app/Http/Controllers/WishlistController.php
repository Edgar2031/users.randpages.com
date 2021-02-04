<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\wishlist;
use App\Product;
use App\ProductImage;
use App\Cart;



class WishlistController extends Controller
{
    
	// <= ======================== Wishlist page ======================== =>
    public function wishlist()
    {
        $wishlist_products = Wishlist::where('user_id', Session::get('id'))->get();
        $new_products = Product::where('status', 'publish')
                                ->orderBy('created_at', 'DESC')
                                ->get();
    	return view('wishlist', compact('wishlist_products'), compact('new_products'));
    }



    // <= ======================== Add product to wishlist ======================== =>
    public function product_item_add_to_wishlist(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $wishlist = Wishlist::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (empty($wishlist)) 
            {
                $add_to_wishlist = new Wishlist();
                $add_to_wishlist->user_id = Session::get('id');
                $add_to_wishlist->product_id = $request->id;
                $add_to_wishlist->save();

                $product = Product::where('id', $request->id)->first();
                return View::make('modal.product_add_to_wishlist', compact('product'));   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    	
    }


    // <= ======================== Remove product of wishlist ======================== =>
    public function product_item_remove_of_wishlist(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $wishlist = Wishlist::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (!empty($wishlist)) 
            {
                Wishlist::where('user_id', Session::get('id'))->where('product_id', $request->id)->delete();
                return View::make('message.wishlist_success');   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    } 



    // <= ======================== Add product to cart of wishlist ======================== =>
    public function product_item_add_to_cart_of_wishlist(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $cart = Cart::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            
            if (empty($cart)) 
            {
                $add_to_cart = new Cart();
                $add_to_cart->user_id = Session::get('id');
                $add_to_cart->product_id = $request->id;
                $add_to_cart->save();
            }

            Wishlist::where('user_id', Session::get('id'))->where('product_id', $request->id)->delete();
            $product = Product::where('id', $request->id)->first();
            return View::make('modal.product_add_to_cart', compact('product'));   
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    }

}
