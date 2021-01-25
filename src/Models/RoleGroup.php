<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleGroup extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role_group';  //自定义的角色表

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    protected $fillable = ['id','name']; //可以被批量赋值的属性


    /**
     * Desc 获取角色组下面的角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->hasMany('App\Models\Role','groupId');
    }
}
