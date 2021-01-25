<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_id')->comment('操作人员');
            $table->string('admin_name')->comment('操作人员名字');
            $table->string('ip')->comment('访问ip')->nullable();
            $table->string('interface_name')->comment('接口名称');
            $table->string('interface_classAction')->comment('接口调用的类名和方法名');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_log` comment '用户操作日志表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_log');
    }
}
