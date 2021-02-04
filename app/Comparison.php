<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comparison extends Model
{
    protected $table = 'comparison';

    public function comparison_product()
    {
        return $this->belongsTo("App\Product", "product_id");
    }

    public function User()
    {
        return $this->belongsTo('App\Users_site', 'user_id');
    }
}
