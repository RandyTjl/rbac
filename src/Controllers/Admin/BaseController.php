<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/3
 * Time: 9:51
 */
namespace App\Http\Controllers\Admin;

use Closure;
use App\Models\MyInterface;

class BaseController extends Controller{

    public function __construct()
    {
        $this->middleware(function ($request, Closure $next) {
            $this->admin_id = $request->get('admin_id');//中间件产生的参数
            $this->dd_userId = $request->get('dd_userId');//中间件产生的参数
            $this->admin_name = $request->get('admin_name');//中间件产生的参数

            $this->isSenior = $request->get('isSenior');
            if ($this->admin_id) {
                $this->adminLog($request);
            }
            return $next($request);
        });


    }

    /**
     * 操作成功
     * @param $msg
     * @param array $data
     * @return string
     */
    public function sucess($msg = '', $data = [])
    {
        $return = [
            'code' => 200,
            'msg' => $msg ?: '操作成功',
            'data' => $data
        ];
        return json_encode($return);
    }

    /**
     * 操作失败
     * @param $code
     * @param $msg
     * @param $data
     * @return array
     */
    public function fail($code, $msg = '', $data = [])
    {
        $return = [
            'code' => $code ?: "10001",
            'msg' => $msg,
            'data' => $data
        ];
        return json_encode($return);
    }

    public function ddReturn($result)
    {
        if ($result['errcode'] == 0) {
            $result['code'] = 200;
            unset($result['errcode']);
        } else {
            $result['code'] = $result['errcode'];
            unset($result['errcode']);
        }
        return json_encode($result);
    }


    public function adminLog($request, $admin_id = '', $admin_name = '')
    {
        $action = $request->route()->getAction();
        $con = $action['controller'];
        $con = explode('\\', $con);
        $co_ac = $con[count($con) - 1];
        $interface = MyInterface::where('classAction', $co_ac)->first();
        if (!$interface) {
            $return = [
                'code' => "10002",
                'msg' => "没有找到匹配的方法",
            ];
            echo json_encode($return);
            exit;
        }

        $admin_id = $admin_id ?: $this->admin_id;
        $admin_name = $admin_name ?: $this->admin_name;

        $input['interface_name'] = $interface->name;
        $input['interface_classAction'] = $interface->classAction;
        $input['admin_id'] = $admin_id;
        $input['admin_name'] = $admin_name;
        $input['ip'] = $request->getClientIp() ?: '';
        $a = AdminLog::create($input);
        if (!$a) {
            $return = [
                'code' => "10002",
                'msg' => "添加用户日志失败",
            ];
            echo json_encode($return);
            exit;
        }
    }

}