<?php namespace Panatau\MyUserRole\Storage;
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 27/10/14
 * Time: 21:49
 */

class PermissionModel extends \Eloquent {
    protected $table = "permissions";
    protected $fillable = ["name", "desc"];

    public function roles()
    {
        return $this->belongsToMany(\Config::get('my-user-role::role'), "permission_role", "permission_id", "role_id");
    }
} 