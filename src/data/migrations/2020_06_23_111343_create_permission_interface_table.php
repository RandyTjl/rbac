<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionInterfaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_interface', function (Blueprint $table) {
            $table->integer('permission_id')->comment('用户id');
            $table->integer('interface_id')->comment('部门id');
        });
        DB::statement("ALTER TABLE `permission_interface` comment '按钮和接口关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_interface');
    }
}
