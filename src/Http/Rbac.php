<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/3
 * Time: 11:09
 */
namespace Randy\Rbac\Http;
use App\Models\Admin;
use App\Models\RoleMenu;
use App\Models\RolePermission;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\MyInterface;

class Rbac{

    protected $admin;
    protected $permissions;
    protected $menus;
    protected $role_ids=[];  //角色id列表
    protected $menu_ids=[];  //菜单id列表
    protected $per_ids=[];   //按钮id列表

    public function __construct($admin_id=''){
        if($admin_id){
            $admin = Admin::getOneAdminInfo($admin_id);
            if(empty($admin)){
                throw new \Exception('用户不存在');
            }
            $this->admin = $admin;
        }
    }

    /**]
     * Desc 获取用户角色
     * @return array
     */
    public function getRoles(){
        if(count($this->role_ids) == 0){
            $role_ids = [];

            foreach ($this->admin->Roles as $k=>$role){
                $role_ids[] = $role->pivot->role_id;
            }
            $this->role_ids = $role_ids;
        }

        return $this->role_ids;
    }

    /**
     * Desc 获取菜单列表的id
     * @return array
     */
    public function getMenu_ids(){
        if(count($this->menu_ids) == 0){
            //获取菜单id列表
            $das = RoleMenu::getInfoByRoleId($this->getRoles());
            $menu_ids = array_column($das,'menu_id');
            $menu_ids = array_unique($menu_ids); //数组去重
            $menu_ids = array_values($menu_ids); //数组索引值重新从0开始递增
            $this->menu_ids = $menu_ids;
        }
        return $this->menu_ids;
    }

    /**
     * Desc 获取菜单按钮列表id
     * @return array
     */
    public function getPer_ids(){
        if(count($this->per_ids) == 0){
            //获取按钮权限id列表
            $per = RolePermission::getInfoByRoleId($this->getRoles());
            $per_ids = array_column($per,'permission_id');
            $per_ids = array_unique($per_ids); //数组去重
            $per_ids = array_values($per_ids); //数组索引值重新从0开始递增
            $this->per_ids = $per_ids;
        }
        return $this->per_ids;
    }

    /**
     * Desc 获取菜单列表
     * @return mixed
     */
    public function getMenus(){
        if(!$this->menus){
            $menus = Menu::getMenus($this->getMenu_ids());
            $this->menus = $menus;
        }

        return $this->menus;
    }

    /**
     * Desc 获取处理后的菜单权限列表
     */
    public function getMenuAll(){
        //获取菜单列表
        $menus = $this->getMenus();
        $menu_all = $this->dealMenu($result=[],$menus);
        return $menu_all;
    }

    public function getPermission(){
        if(!$this->permissions){
            $permissions = Permission::getPermission($this->getPer_ids());
            $this->permissions = $permissions;
        }

        return $this->permissions;
    }

    /**
     * Desc 获取用户权限拥有的按钮权限
     * @return array
     */
    public function getPermissionAll(){
        //获取按钮权限列表
        $permissions = Permission::getPermission($this->getPer_ids());
        $this->permissions = $permissions;
        $per_all = [];  //前端需要的权限组
        foreach ($permissions as $k=>$permission){
            $per_all[] = $permission->menu_per;
        }
        return $per_all;
    }

    public function getInterface(){
        $interfaces = [];  //后台按钮接口权限
        $permissions = $this->getPermission();
        foreach ($permissions as $k=>$permission){
            $inters = $permission->interfaces()->get();
            if($inters !== null){
                foreach ($inters as $k=>$inter){
                    if(!in_array($inter->classAction,$interfaces)){
                        $interfaces[] = $inter->classAction;
                    }
                }
            }
        }

        $inters1 = MyInterface::getCommonInterface(); //获取通用接口,得到所有接口权限
        if($inters1){
            foreach ($inters1 as $k=>$inter){
                if(!in_array($inter->classAction,$interfaces)){
                    $interfaces[] = $inter->classAction;
                }
            }
        }
        return $interfaces;
    }




    /**
     * Desc 处理菜单数据结构
     * @param array $result  处理的结果返回
     * @param $menus    菜单显示
     * @param int $parent_id    父级的菜单id
     * @return array
     */
    private function dealMenu($result=[],$menus,$parent_id=0,$menu_ids=[],$permission_ids=[],$type=1){
        foreach ($menus as $k=>$menu){
            if($menu->parent_id == $parent_id){
                if($parent_id == 0){
                    $result[] = $menu;
                    unset($menus[$k]);
                    $result[count($result)-1]['children'] = dealMenu($result[count($result)-1]['children'],$menus,$menu->id,$menu_ids,$permission_ids,$type);
                }else{
                    $result[] = $menu;
                    unset($menus[$k]);
                    if(count($menus) > 0){
                        $result[count($result)-1]['children'] = dealMenu($result[count($result)-1]['children'],$menus,$menu->id,$menu_ids,$permission_ids,$type);
                    }

                }

                if($type ==2){
                    $result[count($result)-1]['checked'] = false;
                    $result[count($result)-1]['hidden'] = false;

                    if(count($menu_ids)>0){
                        if(in_array($menu->id,$menu_ids)){
                            $result[count($result)-1]['checked'] = true;
                            $result[count($result)-1]['hidden'] = false;
                        }
                    }

                    $per = [];
                    //$menu->permissions[$k]['checked'] = false;
                    if(count($permission_ids)>0 && $menu->permissions){
                        foreach ($menu->permissions as $k1=>$permission){
                            if(in_array($permission->id,$permission_ids)){
                                $menu->permissions[$k1]['checked'] = true;
                            }else{
                                $menu->permissions[$k1]['checked'] = false;
                            }
                            $result[count($result)-1]['permissions'] = $menu->permissions;
                        }
                    }
                }
            }

        }
        return $result;
    }

    /**
     * Desc 操作日志
     * @param $request
     * @param string $admin_id
     * @param string $admin_name
     */
    public function adminLog($request, $admin_id = '', $admin_name = '')
    {
        $action = $request->route()->getAction();
        $con = $action['controller'];
        $con = explode('\\', $con);
        $co_ac = $con[count($con) - 1];
        $interface = MyInterface::getInterfaceByClassAction($co_ac);
        if (!$interface) {
            $return = [
                'code' => "10002",
                'msg' => "没有找到匹配的方法",
            ];
            echo json_encode($return);
            exit;
        }


        $input['interface_name'] = $interface->name;
        $input['interface_classAction'] = $interface->classAction;
        $input['admin_id'] = $admin_id;
        $input['admin_name'] = $admin_name;
        $input['ip'] = $request->getClientIp() ?: '';
        $a = AdminLog::create($input);
        if (!$a) {
            $return = [
                'code' => "10002",
                'msg' => "添加用户日志失败",
            ];
            echo json_encode($return);
            exit;
        }
    }


}