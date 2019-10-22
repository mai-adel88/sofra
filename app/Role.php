<?php

namespace App;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;

class Role extends EntrustRole
{
	protected $table = 'roles';
    protected $fillable = [
    	'name', 'display_name', 'discription'
    ];
    protected $appends = ['permission_list'];

	public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

	public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getPermissionListAttribute()
    {
        return $this->permssions()->pluck('id')->toArray();
    }
}
