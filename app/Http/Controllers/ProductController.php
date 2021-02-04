<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\CategoryProduct;
use App\Product;
use App\ProductImage;
use App\Tags;
use App\Rating;
use App\Review;


class ProductController extends Controller
{
    // <= ======================== Products by category pages ======================== =>
    public function products_by_category($category)
    {
        $cat_id = CategoryProduct::where('name', preg_replace('/\_+/', ' ', $category))->first();

        if (!empty($cat_id)) 
        {
            $products = Product::where('status', 'publish')
                                ->where('cat_id', $cat_id->id)
                                ->orderBy('created_at', 'DESC')
                                ->get();

            return view('catalog', compact('category'), compact('products'))->with('tag', null);
        }
        else
            return view('errors.404');
    }


    
    // <= ======================== Products by category pages ======================== =>
	public function products_by_category_and_tag($category, $tag)
    {
    	$cat_id = CategoryProduct::where('name', preg_replace('/\_+/', ' ', $category))
    								->first();
        $tag_id = Tags::where('name', preg_replace('/\_+/', ' ', $tag))
                        ->first();

    	if (!empty($cat_id) && !empty($tag_id)) 
    	{
	    	$products = Product::where('status', 'publish')
	    						->where('cat_id', $cat_id->id)
	    						->orderBy('created_at', 'DESC')
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
	    	return view('catalog', compact('category'))->with('products', $arr)->with('tag', $tag_id);
    	}
    	else
    		return view('errors.404');
    }
    
    


    // <= ======================== Products by category pages ======================== =>
    public function item_product_view($product_id)
    {
        $item_product = Product::where('id', $product_id)
                                ->where('status', 'publish')
                                ->first();

        $products = Product::where('id', '<>', $product_id)
                                ->where('status', 'publish')
                                ->where('cat_id', $item_product->cat_id)
                                ->limit(4)
                                ->get();

        $new_products = Product::where('id', '<>', $product_id)
                                ->where('status', 'publish')
                                ->where('cat_id', '<>', $item_product->cat_id)
                                ->orderBy('created_at', 'DESC')
                                ->limit(4)
                                ->get();

        $review = Review::where('product_id', $product_id)->get();

        // $cat

        return view('item_product_view', compact('item_product'), compact('products'))->with('new_products', $new_products)->with('review', $review);
    }


    // <= ======================== Add star item product ======================== =>
    public function product_item_add_star(Request $request)
    {
        if (!empty($request) && Session::has('id')) 
        {
            $rating = Rating::where('user_id', Session::get('id'))->where('product_id', $request->id)->first();
            if (!empty($rating)) 
            {
                Rating::where('user_id', Session::get('id'))->where('product_id', $request->id)->update(array('star' => $request->star));
                if (0 == (int)substr(substr(Rating::where('product_id', $request->id)->avg('star'), 0, 3), -1))
                    return substr(Rating::where('product_id', $request->id)->avg('star'), 0, 1);
                else
                    return substr(Rating::where('product_id', $request->id)->avg('star'), 0, 3);   
            }
            else
            {
                $add_star             = new Rating();
                $add_star->user_id    = Session::get('id');
                $add_star->product_id = $request->id;
                $add_star->star       = $request->star;
                $add_star->save();

                if (0 == (int)substr(substr(Rating::where('product_id', $request->id)->avg('star'), 0, 3), -1))
                    return substr(Rating::where('product_id', $request->id)->avg('star'), 0, 1);
                else
                    return substr(Rating::where('product_id', $request->id)->avg('star'), 0, 3);
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    }



    // <= ======================== Add review page ======================== =>
    public function set_review($product_id)
    {
        $item_product = Product::where('id', $product_id)
                                ->where('status', 'publish')
                                ->first();

        $category = CategoryProduct::where('id', $item_product->cat_id)->first();

        return view('set_review', compact('item_product'), compact('category'));
    }



    // <= ======================== Add review ======================== =>
    public function add_review(Request $request, $product_id)
    {
        // dump($request->all());
        // dd($product_id);

        if (!empty($request) && Session::has('id') && !empty($product_id)) 
        {

            $validator = Validator::make(
               $request->all(),
                array(
                    'star'     => 'required|in:1,2,3,4,5',
                    'term_use' => 'in:Менее месяца,Полгода,Более года',
                    // 'dignity'       => '',
                    // 'disadvantages' => ''
                    'comment'  => 'required|max:500'
                )
                // ,
                // array(
                //  'name.required' => 'datark',
                //  'email' => 'address error'
                // )
            );

            if ($validator->fails()) 
            {
                // Переданные данные не прошли проверку
                return Redirect::back()->withInput()->withErrors($validator);
            }
            else 
            {
                $review = Review::where('user_id', Session::get('id'))->where('product_id', $product_id)->first();
                if (!empty($review)) 
                {
                    Review::where('user_id', Session::get('id'))->where('product_id', $product_id)
                            ->update(array(
                                    'star'          => $request->input('star'),
                                    'term_use'      => $request->input('term_use'),
                                    'dignity'       => $request->input('dignity'),
                                    'disadvantages' => $request->input('disadvantages'),
                                    'comment'       => $request->input('comment'),
                            ));
                }
                else
                {
                    $add_review                = new Review();
                    $add_review->user_id       = Session::get('id');
                    $add_review->product_id    = $product_id;
                    $add_review->star          = $request->star;
                    $add_review->term_use      = $request->input('term_use');
                    $add_review->dignity       = $request->input('dignity');
                    $add_review->disadvantages = $request->input('disadvantages');
                    $add_review->comment       = $request->input('comment');
                    $add_review->save();
                }

                return Redirect::to('/item_product_view/' . $product_id);
            }
        }
        else
            return '<script type="text/javascript">location.href = \'/sign_in\'</script>';
    }


    function _get_language_()
    {
        if(isset($_COOKIE['current_lng']) && !empty($_COOKIE['current_lng']))
            return $_COOKIE['current_lng'];
        else
            return null;
    }


    function _get_field_by_lang_($language, $post_id)
    {
        if ($language != null) 
            return get_field('title_' . $language, $post_id);
        else
            return null;
    }

}
