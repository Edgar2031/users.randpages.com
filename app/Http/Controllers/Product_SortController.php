<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\CategoryProduct;
use App\Product;
use App\ProductImage;
use App\Tags;
use App\Rating;


class Product_SortController extends Controller
{
    // <= ======================== Products category pages sort ======================== =>
    public function products_sort_no_tag_category($category, $order_by, $asc_or_desc)
    {
        $cat_id = CategoryProduct::where('name', preg_replace('/\_+/', ' ', $category))
                                    ->first();

        if (!empty($cat_id) || !empty($order_by) || !empty($asc_or_desc)) 
        {
            $products = Product::where('status', 'publish')
                                ->where('cat_id', $cat_id->id)
                                ->orderBy($order_by, $asc_or_desc)
                                ->get();

            return view('catalog', compact('category'), compact('products'))->with('tag', null)->with($asc_or_desc, $asc_or_desc)->with($order_by, $order_by);
        }
        else
            return view('errors.404');
    }



	// <= ======================== Products category pages sort ======================== =>
    public function products_sort_tag_category($category, $tag, $order_by, $asc_or_desc)
    {

        $cat_id = CategoryProduct::where('name', preg_replace('/\_+/', ' ', $category))
    								->first();
        $tag_id = Tags::where('name', preg_replace('/\_+/', ' ', $tag))
                        ->first();

    	if (!empty($cat_id) || !empty($tag_id) || !empty($order_by) || !empty($asc_or_desc)) 
    	{
	    	$products = Product::where('status', 'publish')
	    						->where('cat_id', $cat_id->id)
                                ->orderBy($order_by, $asc_or_desc)
	    						->get();
            $arr = [];
            foreach ($products as $key) 
            {
                foreach (json_decode($key->product_tag_id) as $value)
                {
                    if ((int)$value == (int)$tag_id->id) 
                    {
                        $arr[] = $key;
                    }
                }
            }
            // dd($arr);
	    	return view('catalog', compact('category'))->with('products', $arr)->with('tag', $tag_id)->with($asc_or_desc, $asc_or_desc)->with($order_by, $order_by);
    	}
    	else
    		return view('errors.404');
    }

}
