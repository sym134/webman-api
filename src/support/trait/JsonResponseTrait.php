<?php

namespace jizhi\api\support\trait;

use Webman\Http\Response;
use Jizhi\Admin\support\SqlRecord;

trait JsonResponseTrait
{
    private array $headers = ['Content-Type' => 'application/json'];
    private int $status_code = 200;

    /**
     * @param string $msg
     * @param mixed  $data
     * @param int    $code
     * @param int    $show
     *
     * @return  \support\Response
     */
    public function fail(string $msg = 'Service error', mixed $data = '', int $code = 1, int $show = 1): Response
    {
        $data = compact('code', 'show', 'msg', 'data');
        return $this->json($data);
    }

    /**
     *
     * @param string $msg
     * @param mixed  $data
     * @param int    $code
     * @param int    $show
     *
     * @return Response
     *
     * Author:sym
     * Date:2024/11/27 21:58
     * Company:极智科技
     */
    public function success(string $msg = '', mixed $data = '', int $code = 0, int $show = 0): Response
    {
        $data = compact('code', 'show', 'msg', 'data');
        return $this->json($data);
    }

    private function json($data): Response
    {
        $additionalData = [];
        if (config('app.debug')) {
            $additionalData['_debug'] = [
                'sql' => SqlRecord::$sql,
            ];
        }
        return new Response($this->status_code, $this->headers, json_encode(array_merge($additionalData, $data), JSON_UNESCAPED_UNICODE));
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function successMessage(string $message = ''): Response
    {
        return $this->success($message);
    }

    public function setHeader(string $key, string $value): static
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setHeaders(array $data): static
    {
        $this->headers = $data;
        return $this;
    }

    /**
     * 设置状态码
     * @param int $code
     *
     * @return $this
     *
     * Author:sym
     * Date:2024/11/27 23:14
     * Company:极智科技
     */
    public function setStatusCode(int $code): static
    {
        $this->status_code = $code;
        return $this;
    }
}
