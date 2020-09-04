<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->string('depart_id', 32)->comment('钉钉部门id');
            $table->string('depart_name', 64)->comment('钉钉部门名字');
            $table->string('parent_id', 32)->default(0)->comment('钉钉父部门id');
            $table->string('address')->comment('单位地址')->nullable();
            $table->char('contact','30')->comment('联系人')->nullable();
            $table->char('mobile','14')->comment('联系电话')->nullable();
            $table->tinyInteger('type')->comment('1业主单位2施工单位3监管部门4是运营平台')->nullable();
            $table->char('province_id',20)->comment('省id')->nullable();
            $table->char('city_id',20)->comment('市id')->nullable();
            $table->char('area_id',20)->comment('地区id')->nullable();

            $table->timestamps();
            $table->softDeletes(); //软删除
        });
        DB::statement("ALTER TABLE `department` comment '钉钉部门表'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department');
    }
}
