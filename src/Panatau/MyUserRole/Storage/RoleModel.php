<?php namespace Panatau\MyUserRole\Storage;
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 18/09/14
 * Time: 14:24
 */

class RoleModel extends \Eloquent {
    protected $table = "roles";
    protected $fillable = ["name", "desc"];

    public function permissions()
    {
        return $this->belongsToMany(\Config::get('my-user-role::permission'), "permission_role", "role_id", "permission_id");
    }
} 