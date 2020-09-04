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
            'id'=>2,
            'parent_id' => '0',
            'name' => '单位管理',
            'path' => '/department',
            'component' => 'PageView',
            'icon' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $menu_data[] = [
            'id'=>3,
            'parent_id' => '0',
            'name' => '设备管理',
            'path' => '/device',
            'component' => 'PageView',
            'icon' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $menu_data[] = [
            'id'=>4,
            'parent_id' => '0',
            'name' => '运营管理',
            'path' => '/operating',
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

        $per_data[] = ["id"=>2,'menu_id' => 2, 'name' => '单位列表', 'path' => '/department/index', 'icon' => '', 'menu_per' => 'department:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>3,'menu_id' => 2, 'name' => '查看详情', 'path' => '/department/show', 'icon' => '', 'menu_per' => 'department:show', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>4,'menu_id' => 2, 'name' => '编辑', 'path' => '/department/update', 'icon' => '', 'menu_per' => 'department:update', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>5,'menu_id' => 3, 'name' => '设备管理', 'path' => '/device/index', 'icon' => '', 'menu_per' => 'device:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>6,'menu_id' => 3, 'name' => '查看详情', 'path' => '/device/show', 'icon' => '', 'menu_per' => 'device:show', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>7,'menu_id' => 3, 'name' => '设备添加/编辑', 'path' => '/device/store', 'icon' => '', 'menu_per' => 'device:store', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>8,'menu_id' => 3, 'name' => '坑位管理', 'path' => '/cesspool/index', 'icon' => '', 'menu_per' => 'cesspool:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>9,'menu_id' => 3, 'name' => '查看详情', 'path' => '/cesspool/show', 'icon' => '', 'menu_per' => 'cesspool:show', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>10,'menu_id' => 3, 'name' => '坑位添加/编辑', 'path' => '/cesspool/store', 'icon' => '', 'menu_per' => 'cesspool:store', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>11,'menu_id' => 5, 'name' => '系统管理', 'path' => '/role/index', 'icon' => '', 'menu_per' => 'role:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>12,'menu_id' => 5, 'name' => '角色详情', 'path' => '/role/show', 'icon' => '', 'menu_per' => 'role:show', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>13,'menu_id' => 5, 'name' => '角色管理', 'path' => '/role/roleManagement', 'icon' => '', 'menu_per' => 'role:roleManagement', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>14,'menu_id' => 5, 'name' => '修改角色', 'path' => '/role/update', 'icon' => '', 'menu_per' => 'role:update', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>15,'menu_id' => 5, 'name' => '角色权限配置', 'path' => '/role/updateRoleAffiliate', 'icon' => '', 'menu_per' => 'role:updateRoleAffiliate', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>16,'menu_id' => 5, 'name' => '操作日志', 'path' => '/log/index', 'icon' => '', 'menu_per' => 'log:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>17,'menu_id' => 4, 'name' => '清掏记录', 'path' => '/clean/index', 'icon' => '', 'menu_per' => 'operating:clear', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>18,'menu_id' => 4, 'name' => '巡检记录', 'path' => '/inspection/index', 'icon' => '', 'menu_per' => 'operating:inspection', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>19,'menu_id' => 4, 'name' => '直播视频', 'path' => 'operating', 'icon' => '', 'menu_per' => 'operating:ie', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        $per_data[] = ["id"=>20,'menu_id' => 3, 'name' => '设备记录', 'path' => '/deviceRecords/index', 'icon' => '', 'menu_per' => 'deviceRecords:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];
        $per_data[] = ["id"=>21,'menu_id' => 3, 'name' => '坑位记录', 'path' => '/cesspoolRecords/index', 'icon' => '', 'menu_per' => 'cesspoolRecords:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];

        DB::table('permission')->insert($per_data);
    }

    public function myInterface(){
        $inter_data[] = ['id'=>1,'name'=>"首页统计数据","interface"=>"/home/index","classAction"=>"HomeController@index"];
        $inter_data[] = ['id'=>2,'name'=>"单位管理","interface"=>"/department/index","classAction"=>"DepartmentController@index"];
        $inter_data[] = ['id'=>3,'name'=>"单位详情","interface"=>"/department/show","classAction"=>"DepartmentController@show"];
        $inter_data[] = ['id'=>4,'name'=>"单位编辑","interface"=>"/department/update","classAction"=>"DepartmentController@update"];

        $inter_data[] = ['id'=>5,'name'=>"设备管理","interface"=>"/device/index","classAction"=>"DeviceController@index"];
        $inter_data[] = ['id'=>6,'name'=>"设备详情","interface"=>"/device/show","classAction"=>"DeviceController@show"];
        $inter_data[] = ['id'=>7,'name'=>"设备添加/编辑","interface"=>"/device/store","classAction"=>"DeviceController@store"];

        $inter_data[] = ['id'=>8,'name'=>"坑位管理","interface"=>"/cesspool/index","classAction"=>"CesspoolController@index"];
        $inter_data[] = ['id'=>9,'name'=>"坑位详情","interface"=>"/cesspool/show","classAction"=>"CesspoolController@show"];
        $inter_data[] = ['id'=>10,'name'=>"坑位添加/编辑","interface"=>"/cesspool/store","classAction"=>"CesspoolController@store"];

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
        $inter_data[] = ['id'=>22,'name'=>"业主单位下拉选择框","interface"=>"/department/getOwnerUnitList","classAction"=>"DepartmentController@getOwnerUnitList"];
        $inter_data[] = ['id'=>23,'name'=>"业主单位id拉取施工单位","interface"=>"/department/getConstructionUnitByOwnerId","classAction"=>"DepartmentController@getConstructionUnitByOwnerId"];
        $inter_data[] = ['id'=>24,'name'=>"登录授权","interface"=>"/login","classAction"=>"AuthController@login"];

        $inter_data[] = ['id'=>25,'name'=>"清掏记录","interface"=>"/clean/index","classAction"=>"CesspoolCleanRecordsController@index"];
        $inter_data[] = ['id'=>26,'name'=>"巡检记录","interface"=>"/inspection/index","classAction"=>"InspectionRecordsController@index"];

        $inter_data[] = ['id'=>27,'name'=>"设备记录","interface"=>"/deviceRecords/index","classAction"=>"DeviceRecordsController@index"];
        $inter_data[] = ['id'=>28,'name'=>"坑位记录","interface"=>"/cesspoolRecords/index","classAction"=>"CesspoolRecordsController@index"];

        DB::table('interface')->insert($inter_data);
    }

    public function per_inter(){

        $per_inter[] = ['permission_id'=>1,'interface_id'=>1];
        $per_inter[] = ['permission_id'=>2,'interface_id'=>2];
        $per_inter[] = ['permission_id'=>3,'interface_id'=>3];
        $per_inter[] = ['permission_id'=>4,'interface_id'=>4];
        $per_inter[] = ['permission_id'=>5,'interface_id'=>5];
        $per_inter[] = ['permission_id'=>6,'interface_id'=>6];
        $per_inter[] = ['permission_id'=>7,'interface_id'=>7];
        $per_inter[] = ['permission_id'=>8,'interface_id'=>8];
        $per_inter[] = ['permission_id'=>9,'interface_id'=>9];
        $per_inter[] = ['permission_id'=>10,'interface_id'=>10];
        $per_inter[] = ['permission_id'=>11,'interface_id'=>11];
        $per_inter[] = ['permission_id'=>12,'interface_id'=>12];
        $per_inter[] = ['permission_id'=>13,'interface_id'=>13];
        $per_inter[] = ['permission_id'=>14,'interface_id'=>14];
        $per_inter[] = ['permission_id'=>15,'interface_id'=>16];
        $per_inter[] = ['permission_id'=>16,'interface_id'=>17];

        $per_inter[] = ['permission_id'=>1,'interface_id'=>18];
        $per_inter[] = ['permission_id'=>7,'interface_id'=>19];
        $per_inter[] = ['permission_id'=>10,'interface_id'=>19];
        $per_inter[] = ['permission_id'=>7,'interface_id'=>21];
        $per_inter[] = ['permission_id'=>10,'interface_id'=>22];
        $per_inter[] = ['permission_id'=>4,'interface_id'=>22];
        $per_inter[] = ['permission_id'=>10,'interface_id'=>23];

        $per_inter[] = ['permission_id'=>17,'interface_id'=>25];
        $per_inter[] = ['permission_id'=>18,'interface_id'=>26];

        $per_inter[] = ['permission_id'=>20,'interface_id'=>27];
        $per_inter[] = ['permission_id'=>21,'interface_id'=>28];

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
