<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('state', 'client_id', 'restaurant_id', 'commission', 'net', 'total', 'payment_method_id', 'cost', 'delivery_fee','address');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item')->withPivot('total_price', 'quantity', 'note');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\PaymentMethod');
    }


}