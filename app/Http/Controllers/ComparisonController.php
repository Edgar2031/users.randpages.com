<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Comparison;
use App\Product;
use App\ProductImage;


class ComparisonController extends Controller
{
	// <= ======================== Comparison page ======================== =>
    public function comparison()
    {
        $products = Comparison::where('user_id', Session::get('id'))->get();
    	return view('comparison', compact('products'));
    }



    // <= ======================== Add product to comparison ======================== =>
    public function product_item_add_to_comparison(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $comparison = Comparison::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (empty($comparison)) 
            {
                $add_to_comparison = new Comparison();
                $add_to_comparison->user_id = Session::get('id');
                $add_to_comparison->product_id = $request->id;
                $add_to_comparison->save();

                $product = Product::where('id', $request->id)->first();
                return View::make('modal.product_add_to_comparison', compact('product'));   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    	
    }


    // <= ======================== Remove product of comparison ======================== =>
    public function product_item_remove_of_comparison(Request $request)    
    {
        if (!empty($request) && Session::has('id')) 
        {
            $comparison = Comparison::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (!empty($comparison)) 
            {
                Comparison::where('user_id', Session::get('id'))->where('product_id', $request->id)->delete();
                return View::make('message.comparison_success');   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    }



    // <= ======================== Remove product of comparison ======================== =>
    public function item_product_delete_of_comparison(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $comparison = Comparison::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (!empty($comparison)) 
            {
                Comparison::where('user_id', Session::get('id'))->where('product_id', $request->id)->delete();
                return View::make('message.comparison_success');   
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    }

}
