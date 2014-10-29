<?php namespace Panatau\MyUserRole\Storage;
/**
 * MyUserRole utility, check the documentation in MyUserRoleInterface
 * User: toni
 * Date: 28/10/14
 * Time: 13:34
 */
use Illuminate\Database\Eloquent\Collection;
use Panatau\MyUserRole\Storage\MyUserRoleInterface;
use Panatau\MyUserRole\Storage\RoleModel;
use Panatau\MyUserRole\Storage\PermissionModel;
use Illuminate\Support\Facades\App;

class MyUserRole implements MyUserRoleInterface{

    public function createRole($roleName, $desc = null)
    {
        return RoleModel::create(['name'=>$roleName, 'desc'=>($desc===null?'null':$desc)]);
    }

    public function createPermission($permName, $desc = null)
    {
        return PermissionModel::create(['name'=>$permName, 'desc'=>($desc===null?'null':$desc)]);
    }

    public function assignPermission($permName, $roleName)
    {
        $role = $this->getRole($roleName);
        $perm = $this->getPermission($permName);
        if($role===null || $perm===null)
        {
            App::abort(500, "Role Untuk $roleName Atau Permission $permName Tidak tersedia dan belum dimasukkan");
        }
        return $role->permissions()->attach($perm);
    }

    public function getRole($roleName)
    {
        return RoleModel::where('name', '=', $roleName)->first();
    }

    public function getPermission($permName)
    {
        return PermissionModel::where('name', '=', $permName)->first();
    }

    public function getCurrentLoggedUser()
    {
        return Auth::getUser();
    }

    public function roleInherit($currRole, $roleInheriteId)
    {
        $currRole->inherit_from_id = $roleInheriteId;
        return $currRole->save();
    }

    /**
     * Lakukan check secara recursive mengingat satu buah role bisa mewarisi kemampuan dari role yang lain
     * @param $permission string|array nama permission yang mau dicheck
     * @param $roles \Illuminate\Support\Collection|RoleModel|string roles do check
     * @return bool
     */
    public function checkRolePermission($permission, $roles)
    {
        $ret = false;
        if(is_string($roles))
        {
            $roles = $this->getRole($roles);
        }
        if($roles instanceof RoleModel)
        {
            $roles = [$roles]; // convert to array :D
        }
        if(!is_array($permission))
        {
            $permission = [$permission]; // convert juga
        }
        // looping dahulu untuk semua roles yang masuk
        foreach ($roles as $role)
        {
            // check untuk link ke permissions yang ada
            foreach ($role->permissions as $perm)
            {
                if(in_array($perm->name, $permission))
                {
                    $ret = true; // bila bener sama
                    break;
                }
            }
            // bila terdapat pewarisan permissions & yang dicari belum didapatkan!
            if($role->inherit_from_id!==null && !$ret)
            {
                $rolesRec = RoleModel::where('id','=',$role->inherit_from_id)->get(); // lakukan pencarian roles
                $ret = $this->checkRolePermission($permission, $rolesRec); // dan lakukan proses pemanggilan ulang recursive
            }
            if($ret)
            {
                break;
            }
        }
        return $ret;
    }

    public function getIsLoggedUserCan($permission)
    {
        return $this->checkRolePermission($permission,$this->getCurrentLoggedUser());
    }

    /**
     * Delete Role
     * @param $roleName String role name
     * @return mixed
     */
    public function deleteRole($roleName)
    {
        $role = $this->getRole($roleName);
        if($role===null)
        {
            App::abort(500, "Role Untuk $roleName Tidak tersedia dan belum dimasukkan");
        }
        return $role->delete();
    }

    /**
     * Delete Permission
     * @param $permName string permission name
     * @return boolean
     */
    public function deletePermission($permName)
    {
        $perm = $this->getRole($permName);
        if($perm===null)
        {
            App::abort(500, "Permission Untuk $permName Tidak tersedia dan belum dimasukkan");
        }
        return $perm->delete();
    }

    /**
     * dissociate permisson of $permName from $roleName
     * @param $permName String permission to dissociate
     * @param $roleName String the role
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function dissociatePermission($permName, $roleName)
    {
        $role = $this->getRole($roleName);
        $perm = $this->getPermission($permName);
        if($role===null || $perm===null)
        {
            App::abort(500, "Role Untuk $roleName Atau Permission $permName Tidak tersedia dan belum dimasukkan");
        }
        return $role->permissions()->detach($perm);
    }
}