<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_site extends Model
{
    protected $table = 'users_site';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

}
