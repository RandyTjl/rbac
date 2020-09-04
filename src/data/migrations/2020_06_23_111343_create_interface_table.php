<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterfaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interface', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',32)->comment('接口名称名字');
            $table->integer('admin_id')->comment('操作者id')->nullable();
            $table->integer('status')->default(1)->comment('1是启用，2是禁用');
            $table->string('interface',64)->comment('接口地址')->nullable();
            $table->string('classAction',64)->comment('访问的后台控制器和方法名整合UserController@index，后端接口判断')->nullable();
            $table->tinyInteger('sort')->default(1)->comment('排序,越大越靠前');
            $table->tinyInteger('type')->default(1)->comment('接口类型,1：默认接口，2：对外接口，3：通用接口');

            $table->timestamps();
            $table->softDeletes(); //软删除
        });
        DB::statement("ALTER TABLE `interface` comment '接口列表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interface');
    }
}
