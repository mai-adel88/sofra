<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    
    protected $fillable = [
        'name', 'email', 'password',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    public function getRoleslistAttribute()
    {
        return $this->roles()->pluck('id')->toArray();
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
