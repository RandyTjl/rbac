<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class CheckInterface
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)  //检查是否拥有接口权限
    {
        $action =  $request->route()->getAction();
        $con = $action['controller'];
        $con = explode('\\',$con);
        $co_ac = $con[count($con)-1];

        $admin_id = $request->get('admin_id');//中间件产生的参数
        $interfances = Cache::get('ca'.$admin_id);

        if(empty($interfances) ||  !in_array($co_ac,$interfances)){
            $return = [
                'code'=>"403",
                'msg'=>"没有权限",
            ];
            echo json_encode($return);exit;
        }

        return $next($request);
    }

}

