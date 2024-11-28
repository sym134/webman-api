<?php

namespace Jizhi\Api\middleware;

use ReflectionClass;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use Jizhi\Api\services\JsonResponse;
use Shopwwi\WebmanAuth\Facade\Auth;

class ApiAuthMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (!$request->expectsJson()) {
            return redirect('/login');
        }

        $controller = new ReflectionClass($request->controller); // 通过反射获取控制器哪些方法不需要登录
        $noNeedLogin = $controller->getDefaultProperties()['noNeedLogin'] ?? [];

        // 访问的方法需要登录
        if (!in_array($request->action, $noNeedLogin)) {
            // 验证token
            if (is_null(Auth::guard('api')->user())) {
                return JsonResponse::make()->setStatusCode(401)->fail(admin_trans('admin.please_login'));
            }
        }

        return $handler($request);
    }
}
