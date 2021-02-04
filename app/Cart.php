<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImage;


class Cart extends Model
{
    protected $table = 'cart';
   //  protected $fillable = [
   //      'user_id', 'product_id',
   //  ];

  	// protected $fillablei = ['image'];

    // public function product_photo()
    // {
    //     return $this->hasMany('App\ProductImage', 'product_id', 'id');
    // }

    public function cat_product()
    {
        return $this->belongsTo("App\Product", "product_id");
    }

    public function User()
    {
        return $this->belongsTo('App\Users_site', 'user_id');
    }

}



