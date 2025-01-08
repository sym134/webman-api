<?php

namespace Api\middleware;

use support\Db;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class RequestLog implements MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function process(Request $request, callable $handler): Response
    {
        if (config('plugin.jizhi.api.app.request_log.enable')){
            // 获取请求信息
            $method = $request->method(); // 请求方法，如 GET 或 POST
            $uri = $request->uri(); // 请求 URI
            $ip = $request->getRealIp($safe_mode = true); // 客户端 IP 地址
            $userAgent = $request->header('User-Agent'); // 用户代理

            // 记录开始时间
            $startTime = microtime(true);

            // 继续处理请求
            $response = $handler($request);

            // 记录结束时间
            $endTime = microtime(true);
            $responseTime = $endTime - $startTime; // 计算响应时间

            // 获取 HTTP 状态码
            $status = $response->getStatusCode();

            // 将请求日志插入到数据库
            Db::table('api_request_logs')->insert([
                'ip' => $ip,
                'method' => $method,
                'uri' => $uri,
                'user_agent' => $userAgent,
                'status' => $status,
                'response_time' => $responseTime,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $response;
    }
}