<?php

namespace App\Http\Middleware;

use Closure;

class CheckTest
{
    /**
     * 自定义测试中间件
     * 检查该条件参数id
     * id 小于等于100 正常；否则，跳转到 there 路由去；
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->id > 100) {
            return redirect()->route('there');
        }
        return $next($request);
    }
}
