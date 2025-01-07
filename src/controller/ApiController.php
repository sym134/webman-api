<?php

namespace Api\controller;


use Api\support\trait\JsonResponseTrait;

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
    protected static array $noNeedLogin = []; // 方法名 ['index', …… ]

}
