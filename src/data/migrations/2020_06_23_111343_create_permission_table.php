<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->comment('菜单id');
            $table->string('name',16)->comment('按钮名字');
            $table->string('path',32)->comment('按钮路径,相当于英文名称');
            $table->string('icon',32)->comment('按钮图标')->nullable();
            $table->integer('admin_id')->comment('操作者id')->nullable();
            $table->integer('status')->default(1)->comment('1是启用，2是禁用');
            $table->string('menu_per',64)->comment('菜单和按钮的整合dept:add这种格式,给前端')->nullable();
            $table->tinyInteger('sort')->default(1)->comment('排序,越大越靠前');


            $table->timestamps();
            $table->softDeletes(); //软删除
        });
        DB::statement("ALTER TABLE `permission` comment '后台按钮权限'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission');
    }
}
