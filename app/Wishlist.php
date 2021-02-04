<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Wishlist extends Model
{
    protected $table = 'wishlist';

    public function wishlist_product()
    {
        return $this->belongsTo("App\Product", "product_id");
    }

    public function User()
    {
        return $this->belongsTo('App\Users_site', 'user_id');
    }
}
