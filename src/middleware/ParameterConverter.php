<?php

namespace Api\middleware;


use Webman\Http\Request;
use Webman\Http\Response;
use Illuminate\Support\Str;
use Webman\MiddlewareInterface;

/**
 *
 *  1. 将前端发送来的请求参数的驼峰命名转换为后端的下划线命名
 *  2. 将后端响应参数的下划线命名转换为前端的驼峰命名
 *
 * ParameterConverterMiddleware
 * Api\middleware
 *
 * Author:sym
 * Date:2024/11/27 17:44
 * Company:极智科技
 */
class ParameterConverter implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (config('plugin.jizhi.api.app.convert_request_name_enable') === true) {
            $this->convertRequestName($request);
        }

        $response = $handler($request);

        if (config('plugin.jizhi.api.app.convert_response_name_enable') === true) {
            $this->convertResponseName($response);
        }

        return $response;
    }

    /**
     * 转换请求参数中的下划线命名转换为驼峰命名
     *
     * @param Request $request
     *
     * @return void
     *
     * Author:sym
     * Date:2024/11/27 17:48
     * Company:极智科技
     */
    private function convertRequestName(Request $request): void
    {
        $this->convertParameterName($request, 'get');
        $this->convertParameterName($request, 'post');
    }

    /**
     * 将参数名称的驼峰命名转换为下划线命名
     *
     * @param Request $request
     * @param string  $method_name
     *
     * @return void
     *
     * Author:sym
     * Date:2024/11/27 17:48
     * Company:极智科技
     */
    private function convertParameterName(Request $request, string $method_name): void
    {
        $parameters = $request->$method_name();
        $newParameters = [];
        foreach ($parameters as $key => $value) {
            $newParameters[Str::snake($key)] = $value;
        }
        $method_name = 'set' . ucfirst($method_name);
        $request->$method_name($newParameters);
    }


    /**
     * 响应参数命名从下划线命名转换为驼峰命名
     *
     * @param Response $response
     *
     * @return void
     *
     * Author:sym
     * Date:2024/11/27 18:18
     * Company:极智科技
     */
    private function convertResponseName(Response $response): void
    {
        $content = $response->rawBody();
        $json = json_decode($content, true);
        if (is_array($json)) {
            $json = $this->recursiveConvertNameToCamel($json);
            $response->withBody(json_encode($json));
        }
    }

    /**
     * 循环迭代将数组键值转换为驼峰格式
     *
     * @param $arr
     *
     * @return mixed
     *
     * Author:sym
     * Date:2024/11/27 18:18
     * Company:极智科技
     */
    private function recursiveConvertNameToCamel($arr): mixed
    {
        if (!is_array($arr)) {
            return $arr;
        }

        $outArr = [];
        foreach ($arr as $key => $value) {
            $outArr[Str::camel($key)] = $this->recursiveConvertNameToCamel($value);
        }

        return $outArr;
    }
}
