<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'region_id', 'pin_code','api_token','active');

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function tokens()
    {
        return $this->morphMany('App\Token','tokenable');
    }
    //protected $hidden =[ ];

}