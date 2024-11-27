<?php

namespace Jizhi\Api\controller;


use Jizhi\Api\support\trait\JsonResponseTrait;

/**
 *
 * ApiController
 * app\api\controller
 *
 * Author:sym
 * Date:2024/11/27 22:01
 * Company:极智科技
 */
abstract class ApiController
{
    use JsonResponseTrait;
    /**
     * 不需要登录的方法
     *
     * @var array
     */
    public array $noNeedLogin = []; // ['index', …… ]

}
