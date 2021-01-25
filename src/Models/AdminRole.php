<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin_role';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['admin_id', 'role_id'];

}
