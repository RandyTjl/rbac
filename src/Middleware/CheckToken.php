<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $token = $request->header('token');
        if($token){
            $admin = Admin::with(['roles'=>function($q){
                $q->select('id as role_id');
            }])->where('token',$token)->first();
            if(empty($admin)){
                $return = [
                    'code'=>"10002",
                    'msg'=>"无效的token",
                ];
                echo json_encode($return);exit;
            }

            if($admin->token_time < time()){
                $return = [
                    'code'=>"10002",
                    'msg'=>"token已过期",
                ];
                echo json_encode($return);exit;
            }
           /* $a = $admin->toArray();
            $roles = $a['roles'];
            $roles = array_column($roles,'role_id');*/

            //$mid_params = ['admin_id'=>$admin->id,'dd_userId'=>$admin->userid,'admin_name'=>$admin->name,'roles'=>$roles,'isSenior'=>$admin->isSenior];
            $mid_params = ['admin_id'=>$admin->id,'dd_userId'=>$admin->userid,'admin_name'=>$admin->name,'isSenior'=>$admin->isSenior];
            $request->attributes->add($mid_params);//添加参数
        }else{
            $return = [
                'code'=>"10002",
                'msg'=>"token不能为空",
            ];
            echo json_encode($return);exit;
        }
        return $next($request);
    }
}
