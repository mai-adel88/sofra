<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model 
{

    protected $table = 'item_order';
    public $timestamps = true;
    protected $fillable = array('order_id', 'special_note', 'item_id', 'total_price', 'quantity');

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

}