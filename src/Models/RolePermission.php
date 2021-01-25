<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    //角色下的按钮权限表

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role_permission';

    /**
     * Desc 通过角色id获取关联表信息
     * @param $role_ids
     * @return mixed
     */
    public function getInfoByRoleId($role_ids=[]){
        $role_permission =  self::whereIn('role_id',$role_ids)->get()->toArray();
        return $role_permission;
    }

}
