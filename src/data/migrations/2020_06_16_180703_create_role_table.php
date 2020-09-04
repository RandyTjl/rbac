<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('groupId')->comment('角色组id');
            $table->string('name', 32)->comment('角色名');
            $table->string('desc')->comment('角色功能描述')->nullable();
            /*$table->tinyInteger('type')->default(1)->comment('1是只能查看自己的数据，2是对应查看自己部门下的所有部门，3是查看所有');*/
            $table->timestamps();
            $table->softDeletes(); //软删除
        });
        DB::statement("ALTER TABLE `role` comment '钉钉的角色'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
