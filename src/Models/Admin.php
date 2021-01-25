<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{

    use SoftDeletes; //使用软删除
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin';

    protected $fillable = ['id', 'userid','token','token_time','unionid','name','tel','wokePlace','remark','mobile','email',
        'orgEmail','active','orderInDepts','isAdmin','isBoss','isLeaderInDepts','isHide','department','position','avatar',
        'hiredDate','jobnumber','extattr','isSenior','stateCode','roles','created_at','updated_at'];


    /**
     * Desc 用户相关角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','admin_role','admin_id','role_id');
    }

    /**
     * Desc 用户关联部门
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('App\Models\Department','admin_department','admin_id','department_id');
    }

    /**
     * Desc 获取单个用户的信息
     * @param $admin_id
     * @return mixed
     */
    public function getOneAdminInfo($admin_id){
        $admin = Admin::where('userid',$admin_id)->with(['Roles'=>function($q){
            $q->select('id','name');
        }])->first();
        return $admin;
    }


}
