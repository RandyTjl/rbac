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
        $this->createOwnRoleMenu();
        $this->createOwnRolePermission();
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

        $per_data[] = ["id"=>2,'menu_id' => 2, 'name' => '系统管理', 'path' => '/role/index', 'icon' => '', 'menu_per' => 'role:index', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),];



        DB::table('permission')->insert($per_data);
    }

    public function myInterface(){
        $inter_data[] = ['id'=>1,'name'=>"首页统计数据","interface"=>"/home/index","classAction"=>"HomeController@index"];

        DB::table('interface')->insert($inter_data);
    }

    /**
     * Desc 权限和接口关联表
     */
    public function per_inter(){

        $per_inter[] = ['permission_id'=>1,'interface_id'=>1];

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

    /**
     * Desc 创建角色和菜单权限关联数据
     */
    public function createOwnRoleMenu(){
        $role_menu[] = ['role_id'=>1,'menu_id'=>1];
        $role_menu[] = ['role_id'=>1,'menu_id'=>2];
        $role_menu[] = ['role_id'=>1,'menu_id'=>3];
        $role_menu[] = ['role_id'=>1,'menu_id'=>4];


    }

    /**
     * Desc 角色和权限关联表
     */
    public function createOwnRolePermission(){
        $role_permission[] = ['role_id'=>1,'permission_id'=>1];
        $role_permission[] = ['role_id'=>1,'permission_id'=>2];

        DB::table('own_role_permission')->insert($role_permission);

    }

}
