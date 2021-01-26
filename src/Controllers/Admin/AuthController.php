<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseControler;
use App\Models\Admin;
use App\Models\Menu;
use App\Models\MyInterface;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\RolePermission;
use App\Models\Permission;
use Illuminate\Http\Request;
use EasyDingTalk\Application;
use Illuminate\Support\Facades\Cache;
use Excel;
use App\Exports\visitsExport;
use App\Models\AdminRole;
use Log;
use Randy\Rbac\Facades\Rbac;


class AuthController extends BaseController{

    protected $config;
    protected $app;

    public function __construct(){

        $this->config = config('dingding');
        $this->app = new Application($this->config['config']);

    }

    /**
     * Desc 钉钉默认登录
     * @param Request $request
     * @return array|string
     */
    public function login(Request $request){
        try{
             $code = $request->get('code');
             if(empty($code)){
                 throw new \Exception('code码不能为空');
             }
             $userInfo = $this->app->user->getUserByCode($code);

             if($userInfo['errcode'] !== 0){
                 throw new \Exception($userInfo['errmsg'],$userInfo['errcode']);
             }
             $rbac = new Rbac($userInfo['userid']);
             $admin = $rbac->getAdmin();


            //测试使用
            /*$admin = Admin::where('id',3)->with(['roles'=>function($q){
                $q->select('id','name');
            }])->first();*/

            $token = $admin->id.$admin->userid.time();
            $token = md5($token);
            //$token = '123';
            $days = 7*24*3600; //7天过期时间
            $token_time = time()+$days;
            $a = Admin::where('userid',$admin->userid)->update(['token'=>$token,'token_time'=>$token_time]);
            $admin->token = $token;
            /*if(!$a){
                throw new \Exception('更新token失败');
            }*/


            //获取菜单和权限列表
            $menu_ids = [];
            $per_ids = [];
            if(empty($role_ids)){ //用户没有权限只能看到自己的被访记录
                /*$menu_ids[] = 1;
                $per_ids[] = 1;*/
                $menu_ids = [1,2];
                $per_ids = [1,2,3];
            }else{
                //获取菜单id列表
                $menu_ids = $rbac->getMenu_ids();
                //获取按钮权限id列表
                $per_ids = $rbac->getPer_ids();
            }
            //获取菜单列表
            $menu_all = $rbac->getMenuAll($menu_ids);
            //获取按钮权限列表
            $per_all = $rbac->getPermissionAll($per_ids);


            $return = [
                'admin'=>$admin,
                'menus'=>$menu_all,
                'permissions'=>$per_all,
            ];

            $interfaces = $rbac->getInterface();  //后台按钮接口权限


            //$timeout = 7*24*60; //单位分钟
            Cache::put('ca'.$admin->id,$interfaces,$days); //存储接口权限，用来做接口验证

            $this->adminLog($request,$admin->id,$admin->name); //保存用户日志

            return $this->sucess('登录成功',$return);
        }catch (\Exception $e){
            return $this->fail($e->getCode(),$e->getMessage());
        }

    }


    /**
     * Desc 设置超级管理员
     * @param Request $request
     * @return array|string
     */
    public function setAdmin(Request $request){
        try{
            $params = $request->all();
            if(!$params){
                throw new \Exception('输入条件不能为空');
            }
            $admin = Admin::where($params)->first();
            if(!$admin){
                throw new \Exception('用户不存在');
            }
            RoleMenu::where('role_id',1520499980)->delete();
            $menus = Menu::all();
            $menu_role = [];
            foreach ($menus as $k=>$menu){
                $menu_role[$k]['role_id'] = 1520499980;
                $menu_role[$k]['menu_id'] = $menu->id;
            }
            $a = RoleMenu::insert($menu_role);
            if(!$a){
                throw new \Exception('菜单权限添加失败');
            }


            $permissions = Permission::all();
            $per_role = [];
            foreach ($permissions as $k=>$permission){
                $per_role[$k]['role_id'] = 1520499980;
                $per_role[$k]['permission_id'] = $permission->id;
            }
            RolePermission::where('role_id',1520499980)->delete();
            $b = RolePermission::insert($per_role);
            if(!$b){
                throw new \Exception('按钮权限添加失败');
            }

            $admin_role['admin_id'] = $admin->id;
            $admin_role['role_id'] = 1520499980;
            AdminRole::where(['role_id'=>1520499980,'admin_id'=>$admin->id])->delete();
            $c = AdminRole::insert($admin_role);
            if(!$b){
                throw new \Exception('用户定义角色失败');
            }
            return $this->sucess('',$admin);
        }catch (\Exception $e){
            return $this->fail($e->getCode(),$e->getMessage());
        }
    }


    /**
     * Desc 测试使用
     * @param Request $request
     */
    public function test(Request $request){
        $cellData = [
            [1,2,3,4]
        ];

        $export = new visitsExport($cellData);

        return Excel::download($export, 'invoices.xlsx');

        /* $data = $request->all();
         $data = json_encode($data);
         Cache::put('modian',$data,20);
         $re = [
             'status'=>"ok",
             "message"=>"操作成功"
         ];
         return json_encode($re);*/
    }



}
