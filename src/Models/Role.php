<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    use SoftDeletes; //使用软删除
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role';  //自定义的角色表

    protected $fillable = ['id','groupId','name','desc','created_at','updated_at','admin_id']; //可以被批量赋值的属性

    /**
     * Desc 获取角色下的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {

        return $this->belongsToMany('App\Models\Admin','admin_role','role_id');
    }

    /**
     * Desc 获取角色下的菜单权限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus(){
        return $this->belongsToMany('App\Models\Menu','role_menu','role_id');
    }

    /**
     * Desc 获取角色下的按钮权限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(){
        return $this->belongsToMany('App\Models\Permission','role_permission','role_id');
    }

    /**
     * Desc 获取角色下的菜单权限id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menu_ids(){
        return $this->hasMany('App\Models\RoleMenu','role_id');
    }

    /**
     * Desc 获取角色下的菜单权限id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permission_ids(){
        return $this->hasMany('App\Models\RolePermission','role_id');
    }

    /**
     * Desc 获取用户角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role_group(){
        return $this->belongsTo('App\Models\RoleGroup','groupId');
    }
}
