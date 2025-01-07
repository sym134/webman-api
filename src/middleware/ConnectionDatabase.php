<?php

namespace Api\middleware;

use Api\support\SqlRecord;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * 连接数据库
 * ConnectionDatabase
 * plugin\saas\app\middleware
 *
 * Author:sym
 * Date:2024/6/17 下午3:47
 * Company:极智网络科技
 */
class ConnectionDatabase implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (str_starts_with($request->route->getPath(), '/' . config('plugin.jizhi.admin.admin.route.prefix'))) {
            if (config('app.debug')) {
                SqlRecord::$sql = []; // 清空sql记录
            }
        }
        return $handler($request);
    }

}
