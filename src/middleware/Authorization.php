<?php

namespace Api\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use WebmanAuth\exception\JwtTokenException;
use WebmanAuth\facade\Auth;

class Authorization implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (!$request->expectsJson()) {
            return redirect('/login');
        }

        $controller = $request->controller;
        $action = $request->action;

        // 检查控制器是否定义了无需登录的方法
        if (property_exists($controller, 'noNeedLogin') && in_array($action, $controller::$noNeedLogin)) {
            // 如果该方法在 noNeedLogin 中，不需要验证token
            return $handler($request);
        }

        // 如果不在 noNeedLogin 中，则需要验证 token
        if (is_null(Auth::guard('api')->user())) {
            throw new JwtTokenException('Unauthenticated.', 401);
        }

        return $handler($request);
    }
}
