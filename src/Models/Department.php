<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{

    use SoftDeletes; //使用软删除
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'department';

    //protected $fillable = ['id','depart_id','depart_name','created_at','updated_at','parent_id']; //可以被批量赋值的属性
    protected $guarded = ['deleted_at'];

    /**
     * Desc 部门关联用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {
        return $this->belongsToMany('App\Models\Admin','admin_department','department_id','admin_id');
    }

    /**
     * Desc 部门关联用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cons()
    {
        return $this->belongsToMany('App\Models\Department','construction_owner','owner_id','construction_id');
    }

    /**
     * Desc 业主含有那些坑位
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cesspools(){
        return $this->hasMany('App\Models\Cesspool','owner_unit_id');
    }

    /**
     * Desc 获取所有部门列表
     * @return mixed
     */
    public static function getDept(){
        return self::get()->toArray();
    }

    /**
     * Desc 处理部门类型
     */
    public static function dealDeptType(){
        $depts = self::whereNull('type')->orWhere('type',0)->get();

        foreach ($depts as $k=>$dept){
            $dept_parents = self::getParent($dept,$dept_parents=[],3,1);

            if($dept_parents){
                $dept->type = $dept_parents['type'];
                $dept->save();
            }
        }
    }

    /**
     * Desc 获取部门父级部门
     * @param $deptInfo  初始部门，要获取的对象
     * @param array $dept_parents 部门父级对象
     * @param int $type  操作类型，1是获取父级部门id,2是获取部门对象,3是获取某一个父级的数据
     * @param string $parant_id  如果有值，是获取父级的父级parent_id为这个值的部门对象
     * @return array
     */
    public static function getParent($deptInfo,$dept_parents=[],$type=1,$parent_id=0){

        $depts = self::get();
        foreach ($depts as $k=>$dept){
            if($deptInfo->parent_id == $dept->id ){

                if($type == 1){
                    $dept_parents[] = $dept->id;
                }elseif ($type == 2){
                    $dept_parents[] = $dept;
                }else{
                    $dept_parents = $dept->toArray();
                }

                if($dept->parent_id == $parent_id){
                    break;
                }

                $dept_parents = self::getParent($dept,$dept_parents,$type,$parent_id);
            }
        }
        return $dept_parents;
    }

}
