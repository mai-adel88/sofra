<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model 
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'region_id', 'password', 'mini_charge', 'delivery_fee', 'phone_delivery', 'whatsapp', 'review_id', 'image', 'order_id','api_token', 'pin_code', 'status', 'category_id');

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function comments()
    {
        return $this->hasMany('App\Review');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function notifications()
    {
        return $this->morphMany('App\Notification','notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Token','tokenable');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function offers()
    {
        return $this->hasMany('App\ItemOffer');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    protected $hidden =[ 'api_token'];

}