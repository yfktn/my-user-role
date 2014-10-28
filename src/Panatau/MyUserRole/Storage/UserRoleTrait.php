<?php namespace Panatau\MyUserRole\Storage;
use ClassPreloader\Config;
use Illuminate\Support\Facades\App;
use Panatau\MyUserRole\Storage\RoleModel;
use Symfony\Component\Debug\ExceptionHandler;

/**
 * Roles related for UserModel.
 * User: toni
 * Date: 27/10/14
 * Time: 21:38
 */
trait UserRoleTrait {

    /**
     * get related groups of current user
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('my-user-role::role'), "role_user", "user_id", "role_id");
    }

    /**
     * Check if current user is have Role as $roleName
     * TODO: what if $roleName is array?
     * @param $roleName string
     * @return bool
     */
    public function haveRoleAs($roleName)
    {
        $found = false;
        $roles = $this->roles;
        foreach ($roles as $role)
        {
            if(strtolower($role['name']) == strtolower($roleName))
            {
                $found = true;
                break;
            }
        }
        return $found;
    }

    public function isMemberOf($groupName)
    {
        return $this->haveRoleAs($groupName);
    }

    /**
     * Check bila user ini memiliki kemampuan untuk melakukan sebagaimana yang ditentukan oleh $permission
     * @param $permission string
     * @return bool
     */
//    public function can($permission)
//    {
//        return $this->checkRolePermission($permission, $this->roles);
//    }

    public function addRole($roleName)
    {
        $roleModel = null;
        if(is_string($roleName))
        {
            $roleModel = RoleModel::where('name','=', $roleName)->first();
        }
        else
        {
            $roleModel = $roleName;
        }
        if($roleModel == null)
        {
            App::abort(500, "Role Untuk $roleName Tidak tersedia dan belum dimasukkan");
        }
        return $this->roles()->save($roleName);
    }
}