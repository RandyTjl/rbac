<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{

    use SoftDeletes; //使用软删除
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * Desc 拥有某个权限的所有角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany('App\Models\Role','role_menu');
    }

    /**
     * Desc 菜单下的子权限按钮
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions(){
        return $this->hasMany('App\Models\Permission');
    }

    /**
     * Desc 获取菜单列表详情
     * @param array $menu_ids
     * @return mixed
     */
    public function getMenus($menu_ids=[]){
        $menus = self::whereIn('id',$menu_ids)->where('status',1)->select('id','name','path','component','icon','closeable','isShow')->get();
        return $menus;
    }
}
