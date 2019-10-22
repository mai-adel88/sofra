<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model 
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('city_id', 'name');

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}