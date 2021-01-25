<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminLog extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin_log';

    protected $fillable = ['id', 'admin_id', 'admin_name', 'ip', 'interface_name', 'interface_classAction', 'created_at', 'updated_at'];

    /**
     * Desc 关联用户
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
