<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CategoryProduct extends Model
{
   	protected $table = 'category_products';

   	public function cat_tags()
    {
        return $this->hasMany('App\Tags', 'tag_id');
    }
}
