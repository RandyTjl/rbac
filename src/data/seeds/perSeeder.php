<?php

use Illuminate\Database\Seeder;

class perSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->menu();
        $this->permission();
        $this->myInterface();
        $this->per_inter();
        $this->createRole();
    }

    public function menu(){
        $menu_data[] = [
            'id'=>1,
            'parent_id' => 0,
            'name' => '首页',
            'path' => '/home',
            'component' => 'PageView',
            'icon' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $menu_data[] = [
            'id'=>5,
            'parent_id' => '0',
            'name' => '系统管理',
            'path' => '/role',
            'component' => 'PageView',
            'icon' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        DB::table('menu')->insert($menu_data);
    }

    public function permission(){

        $per_data[] = ["id"=>1,'menu_id' => 1, 'name' => '首页', 'path' => '/home/index', 'icon' => '', 'menu_per' => 'home:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];


        $per_data[] = ["id"=>11,'menu_id' => 5, 'name' => '系统管理', 'path' => '/role/index', 'icon' => '', 'menu_per' => 'role:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>12,'menu_id' => 5, 'name' => '角色详情', 'path' => '/role/show', 'icon' => '', 'menu_per' => 'role:show', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>13,'menu_id' => 5, 'name' => '角色管理', 'path' => '/role/roleManagement', 'icon' => '', 'menu_per' => 'role:roleManagement', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>14,'menu_id' => 5, 'name' => '修改角色', 'path' => '/role/update', 'icon' => '', 'menu_per' => 'role:update', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>15,'menu_id' => 5, 'name' => '角色权限配置', 'path' => '/role/updateRoleAffiliate', 'icon' => '', 'menu_per' => 'role:updateRoleAffiliate', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>16,'menu_id' => 5, 'name' => '操作日志', 'path' => '/log/index', 'icon' => '', 'menu_per' => 'log:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];



        DB::table('permission')->insert($per_data);
    }

    public function myInterface(){
        $inter_data[] = ['id'=>1,'name'=>"首页统计数据","interface"=>"/home/index","classAction"=>"HomeController@index"];



        $inter_data[] = ['id'=>11,'name'=>"系统管理","interface"=>"/role/index","classAction"=>"RoleController@index"];
        $inter_data[] = ['id'=>12,'name'=>"角色权限账号接口","interface"=>"/role/show","classAction"=>"RoleController@show"];
        $inter_data[] = ['id'=>13,'name'=>"获取菜单和按钮权限","interface"=>"/role/getMenuPermission","classAction"=>"RoleController@getMenuPermission"];
        $inter_data[] = ['id'=>14,'name'=>"修改角色","interface"=>"/role/update","classAction"=>"RoleController@update"];
        $inter_data[] = ['id'=>15,'name'=>"根据条件查询账号","interface"=>"/admin/getAdminInfo","classAction"=>"AdminController@getAdminInfo"];
        $inter_data[] = ['id'=>16,'name'=>"修改或添加角色相关属性（角色关联权限，关联账户）","interface"=>"/role/updateRoleAffiliate","classAction"=>"RoleController@updateRoleAffiliate"];

        $inter_data[] = ['id'=>17,'name'=>"操作日志","interface"=>"/log/index","classAction"=>"AdminLogController@index"];

        $inter_data[] = ['id'=>18,'name'=>"首页搜索","interface"=>"/home/getMapData","classAction"=>"HomeController@getMapData"];
        $inter_data[] = ['id'=>19,'name'=>"图片上传","interface"=>"/form/fileUpload","classAction"=>"RequestController@fileUpload"];
        $inter_data[] = ['id'=>20,'name'=>"省市区3级联动","interface"=>"/admin/getProvinceCityList","classAction"=>"RequestController@fileUpload"];
        $inter_data[] = ['id'=>21,'name'=>"坑位下拉选择框","interface"=>"/cesspool/getCesspoolList","classAction"=>"CesspoolController@getCesspoolList"];

        $inter_data[] = ['id'=>24,'name'=>"登录授权","interface"=>"/login","classAction"=>"AuthController@login"];



        DB::table('interface')->insert($inter_data);
    }

    public function per_inter(){

        $per_inter[] = ['permission_id'=>1,'interface_id'=>1];

        $per_inter[] = ['permission_id'=>11,'interface_id'=>11];
        $per_inter[] = ['permission_id'=>12,'interface_id'=>12];
        $per_inter[] = ['permission_id'=>13,'interface_id'=>13];
        $per_inter[] = ['permission_id'=>14,'interface_id'=>14];
        $per_inter[] = ['permission_id'=>15,'interface_id'=>16];
        $per_inter[] = ['permission_id'=>16,'interface_id'=>17];


        DB::table('permission_interface')->insert($per_inter);
    }

    public function createRole(){
        $role['id'] = 1;
        $role['name'] = "超级管理员";
        $role['desc'] = "超级管理员";
        //$role['admin_id'] = 1;
        $role['created_at'] = date("Y-m-d H:i:s");
        $role['updated_at'] = date("Y-m-d H:i:s");

        DB::table('role')->insert($role);
    }

}
