<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryRestaurant extends Model 
{

    protected $table = 'category_restaurant';
    public $timestamps = true;
    protected $fillable = array('category_id', 'restaurant_id');

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Restaurant');
    }

}