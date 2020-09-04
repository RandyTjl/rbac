<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('role_id')->comment('角色id');
            $table->integer('menu_id')->comment('菜单id');

        });
        DB::statement("ALTER TABLE `role_menu` comment '角色菜单关联表'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_menu');
    }
}
