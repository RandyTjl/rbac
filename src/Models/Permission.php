<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{

    use SoftDeletes; //使用软删除
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'permission';


    /**
     * Desc 获取拥有这个按钮权限的所有角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_permission');
    }

    /**
     * Desc 按钮关联的接口
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interfaces(){
        return $this->belongsToMany('App\Models\MyInterface','permission_interface','permission_id','interface_id');
    }

    /**
     * Desc 通过按钮id获取按钮详情
     * @param array $per_ids
     * @return mixed
     */
    public static function getPermission($per_ids=[]){
        $permisson =  self::whereIn('id',$per_ids)->where('status',1)->get();
        return $permisson;
    }

}
