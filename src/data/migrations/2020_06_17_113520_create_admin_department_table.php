<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_department', function (Blueprint $table) {
            $table->integer('admin_id')->comment('用户id');
            $table->integer('department_id')->comment('部门id');
        });
        DB::statement("ALTER TABLE `admin_department` comment '用户部门关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_department');
    }
}
