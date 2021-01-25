<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyInterface extends Model
{

    use SoftDeletes; //使用软删除
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'interface';

    //protected $fillable = [];


    /**
     * Desc 用户相关角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission','permission_interface','interface_id','permission_id');
    }

    /**
     * Desc 获取公共的接口（所有人都可调用的接口）
     * @return mixed
     */
    public function getCommonInterface(){
        $interface = self::where('type',3)->get();
        return $interface;
    }

    /**
     * Desc 通过请求的类操作获取接口信息
     * @param $classAction
     * @return mixed
     */
    public function getInterfaceByClassAction($classAction){
        $interface = self::where('classAction', $classAction)->first();
        return $interface;
    }

}
