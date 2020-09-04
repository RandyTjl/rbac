<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid', 32)->comment('钉钉用户id');
            $table->string('token', 32)->comment('用户登录的token')->nullable();
            $table->integer('token_time')->comment('token的过期时间')->nullable();
            $table->string('unionid', 64)->comment('员工在当前账号的唯一标识')->nullable();
            $table->string('name', 32)->comment('员工名字')->nullable();
            $table->string('tel', 32)->comment('分机号')->nullable();
            $table->string('wokePlace', 255)->comment('办公地点')->nullable();
            $table->text('remark')->comment('钉钉那边的备注')->nullable();
            $table->text('mobile')->comment('手机号')->nullable();
            $table->text('email')->comment('员工的电子邮箱')->nullable();
            $table->text('orgEmail')->comment('员工的企业邮箱')->nullable();
            $table->tinyInteger('active')->default('0')->comment('是否已经激活,1是已经激活，0是未激活');
            $table->text('orderInDepts')->comment('在对应的部门中的排序，Map结构的json字符串，key是部门的id，value是人员在这个部门的排序值')->nullable();
            $table->tinyInteger('isAdmin')->default('0')->comment('是否为企业的管理员，1表示是，0表示不是');
            $table->tinyInteger('isBoss')->default('0')->comment('是否为企业的老板，1表示是，0表示不是');
            $table->text('isLeaderInDepts')->comment('在对应的部门中是否为主管：Map结构的json字符串，key是部门的id，value是人员在这个部门中是否为主管，true表示是，false表示不是')->nullable();
            $table->tinyInteger('isHide')->default('0')->comment('是否号码隐藏，1表示隐藏，0表示不隐藏');
            $table->string('department', 255)->comment('成员所属部门id列表')->nullable();
            $table->string('position', 255)->comment('职位信息')->nullable();
            $table->string('avatar', 255)->comment('头像url')->nullable();
            $table->string('hiredDate', 255)->comment('入职时间')->nullable();
            $table->string('jobnumber', 255)->comment('工号')->nullable();
            $table->text('extattr')->comment('扩展属性')->nullable();
            $table->tinyInteger('isSenior')->default('0')->comment('是否是高管,1是，0不是');
            $table->string('stateCode', 16)->comment('国家地区码')->nullable();
            $table->text('roles' )->comment('用户所在钉钉角色列表')->nullable();
            $table->timestamps();
            $table->softDeletes(); //软删除
        });
        DB::statement("ALTER TABLE `admin` comment '用户列表（同步于钉钉）'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
