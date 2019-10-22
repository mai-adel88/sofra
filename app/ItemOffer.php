<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOffer extends Model 
{

    protected $table = 'item_offers';
    public $timestamps = true;
    protected $fillable = array('product_offer_name', 'description', 'from', 'to', 'image', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

}