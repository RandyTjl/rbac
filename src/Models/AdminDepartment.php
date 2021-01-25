<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AdminDepartment extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin_department';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['admin_id', 'department_id'];

    /**
     * Desc 钉钉审批相关联的用户
     * @param $depart_id
     * @param string $cc_position
     * @param string $task_action_type
     * @return string
     */
    public static function getDepartAdmin($depart_id,$cc_position='START',$task_action_type='OR'){
        $return['depart_id'] = $depart_id;
        $return['user_ids'] = '';
        $return['task_action_type'] = $task_action_type;
        $return['cc_position'] = $cc_position;
        $admins = self::where('department_id',$depart_id)->select('admin_id')->get()->toArray();

        $admins = array_column($admins,'admin_id');

        if(count($admins)== 0){
            return '';
        }
        if(count($admins) == 1){
            $return['task_action_type'] = 'NONE';
            $adminInfo = Admin::where('id',$admins[0])->first();
            $return['user_ids'] = $adminInfo->userid;
            return $return;
        }
        if (count($admins) > 20) {
            $admins = array_slice($admins, 0, 20);
        }

        $userInfo = Admin::whereIn('id',$admins)->select('userid')->get()->toArray();
        $user_ids = array_column($userInfo,'userid');
        $return['user_ids'] = $user_ids;
        return $return;
    }

}
