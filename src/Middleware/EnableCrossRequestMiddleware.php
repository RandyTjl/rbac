<?php
namespace App\Http\Middleware;
use Closure;
class EnableCrossRequestMiddleware{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        header('Content-Type:*;charset=utf-8');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST,GET,PUT,OPTIONS,DELETE'); // 允许请求的类型
        header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
        //header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Origin,Access-token,Content-Length,Accept-Encoding,X-Requested-with, Origin,Access-Control-Allow-Methods,token,Access-Control-Allow-Credentials"); // 设置允许自定义请求头的字段
        header('Access-Control-Allow-Headers:*'); // 设置允许自定义请求头的字段
        header('Access-Control-Max-Age: 3600');  //避免一直访问两次Method:OPTIONS请求允许方法

        return $next($request);
    }
}