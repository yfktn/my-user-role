<?php namespace Panatau\MyUserRole\Facades;
/**
 * Facades
 * User: toni
 * Date: 29/10/14
 * Time: 9:49
 */
use Illuminate\Support\Facades\Facade;

class MyAppRoleFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'MyUserRole';
    }
} 