<?php namespace Panatau\MyUserRole\Storage;
/**
 * MyUserRole Contract
 * User: toni
 * Date: 28/10/14
 * Time: 13:28
 */
interface MyUserRoleInterface {
    /**
     * Create new role
     * @param $roleName String name of Role
     * @param null $desc String description
     * @return RoleModel
     */
    public function createRole($roleName, $desc=null);

    /**
     * Create new permission
     * @param $permName String name of permission
     * @param null $desc String description
     * @return PermissionModel
     */
    public function createPermission($permName, $desc=null);

    /**
     * Assign Permission as Role part
     * @param $permName String Permission Name
     * @param $roleName String Role Name
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function assignPermission($permName, $roleName);

    /**
     * Return RoleModel base on roleName
     * @param $roleName String role name to search
     * @return RoleModel
     */
    public function getRole($roleName);

    /**
     * Return PermissionModel based on permName
     * @param $permName String permission to search
     * @return PermissionModel
     */
    public function getPermission($permName);

    /**
     * Get current logged user
     * @return User model
     */
    public function getCurrentLoggedUser();

    /**
     * Check if current logged user can do $permission
     * @param $permission String permission to check
     * @return boolean
     */
    public function getIsLoggedUserCan($permission);

    /**
     * Set $currRole inherit permissions of $roleInheriteId
     * @param $currRole RoleModel
     * @param $roleInheriteId Int the id of inherited module
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function roleInherit($currRole, $roleInheriteId);

    /**
     * Check if $permission allowed base on $roles given
     * @param $permission String|Array permission to check
     * @param $roles RoleModel|Collection of Role to check
     * @return boolean
     */
    public function checkRolePermission($permission, $roles);

    /**
     * Delete Role
     * @param $roleName String role name
     * @return mixed
     */
    public function deleteRole($roleName);

    /**
     * Delete Permission
     * @param $permName string permission name
     * @return mixed
     */
    public function deletePermission($permName);

    /**
     * dissociate permisson of $permName from $roleName
     * @param $permName String permission to dissociate
     * @param $roleName String the role
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function dissociatePermission($permName, $roleName);

}