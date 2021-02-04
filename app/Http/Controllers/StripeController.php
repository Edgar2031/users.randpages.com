<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Stripe;


class StripeController extends Controller
{
    /**
	* success response method.
	*
	* @return \Illuminate\Http\Response
	*/
    public function stripe()
    {
    	return view('stripe');
    }


    /**
	* success response method.
	*
	* @return \Illuminate\Http\Response
	*/
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Stripe\Charge::create ([
            "amount" => Session::get('sum') * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com." 
        ]);

        // if ($charge['status'] == 'succeeded') 
        // {
        //     $order = new OrderModel();
        //     $order->user_id = Session::get('id');
        //     $order->sum = Session::get('sum');
        //     $order->save();
        //     $cart = CartModel::where('user_id', Session::get('id'))->get();
        //     foreach ($cart as $v) {
        //         $ord_det = new OrderDetailModel();
        //         $ord_det->order_id = $order->id;
        //         $ord_det->product_id = $v->product_id;
        //         $ord_det->price = $v->Pro_product->price;
        //         $ord_det->count = $v->count;
        //         $ord_det->save();
        //         $pr_count = $v->Pro_product->count - $v->count;
        //         if ($pr_count <= 0) {
        //             ProductModel::where('id', $v->product_id)->delete();
        //         }else {
        //             ProductModel::where('id', $v->product_id)->update([
        //                 'count' => $pr_count
        //             ]);
        //         }
        //     }
        // }
        // Session::put('sum', 0);
        // CartModel::where('user_id', Session::get('id'))->delete();
        Session::flash('success', 'Payment successful!');
        return back();
    }
}
