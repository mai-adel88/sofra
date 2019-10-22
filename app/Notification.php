<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'notifiable_id', 'notifiable_type', 'order_id');

    public function clients()
    {
        return $this->morphMany('App\Client');
    }

    public function restaurants()
    {
        return $this->morphMany('App\Restaurant');
    }

     public function notifiable()
    {
        return $this->morphTo();
    }

}