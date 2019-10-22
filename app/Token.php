<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model 
{

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('tokenable_id', 'tokenable_type', 'type', 'token');

    public function client()
    {
        return $this->morphMany('App\Client');
    }

    public function restaurant()
    {
        return $this->morphMany('App\Restaurant');
    }

}