<?php

namespace App;
use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\Model;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';
    protected $fillable = [
    	'name', 'display_name', 'discription'
    ];
}
