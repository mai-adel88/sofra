<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model 
{

    protected $table = 'items';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'time_of_preparation', 'image', 'offer_price', 'restaurant_id');

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}