<?php namespace Panatau\MyUserRole\Storage;
/**
 * MyUserRole Contract
 * User: toni
 * Date: 28/10/14
 * Time: 13:28
 */
interface MyUserRoleInterface {
    public function createRole($roleName, $desc=null);
    public function createPermission($permName, $desc=null);
    public function assignPermission($permName, $roleName);
    public function getRole($roleName);
    public function getPermission($permName);
    public function getCurrentLoggedUser();
    public function getLoggedUserCan($permission);
    public function roleInherit($currRole, $roleInheriteId);
    public function checkRolePermission($permission, $roles);
}