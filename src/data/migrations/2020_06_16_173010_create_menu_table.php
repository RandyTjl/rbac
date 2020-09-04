<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('菜单父级id');
            $table->string('name', 32)->comment('功能名称');
            $table->string('path', 32)->comment('跳转链接');
            $table->string('component', 32)->default('PageView')->comment('前端组件地址');
            $table->string('icon', 32)->comment('菜单图标')->nullable();
            $table->integer('admin_id')->comment('添加者用户id')->nullable();
            $table->enum('closeable', ['true', 'false'])->default('true')->comment('是否关闭,true是关闭，false是打开');
            $table->enum('isShow', ['true', 'false'])->default('true')->comment('是否显示,true是打开，false是关闭');
            $table->integer('status')->default(1)->comment('1是启用，2是禁用');

            $table->timestamps();
            $table->softDeletes(); //软删除
        });
        DB::statement("ALTER TABLE `menu` comment '后台菜单权限'");
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
