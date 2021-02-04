<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    protected $table = 'review';


    public function users_review()
    {
        return $this->hasMany('App\Users_site', 'id', 'user_id');
    }
}
