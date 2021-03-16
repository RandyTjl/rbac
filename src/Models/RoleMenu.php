<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role_menu';


    /**
     * Desc 根据角色id获取关联表信息
     * @param array $role_ids 角色id列表
     * @return mixed
     */
    public static function getInfoByRoleId($role_ids=[]){
        $role_menus =  self::whereIn('role_id',$role_ids)->get()->toArray();
        return $role_menus;
    }

}
