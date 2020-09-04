<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/3
 * Time: 10:02
 */
namespace Randy\Rbac\Facades;

use Illuminate\Support\Facades\Facade;


class Rbac extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rbac';
    }
}
