<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CategorySlider extends Model
{
    public function slider()
    {
        return $this->belongsTo('App\Slider', 'slider_id', 'id');
    }
}
