<?php

return [
    'api' => [
        \Jizhi\Api\middleware\ConnectionDatabase::class,
        \Jizhi\Api\middleware\ApiAuthMiddleware::class,
        \Jizhi\Api\middleware\ParameterConverterMiddleware::class,
    ],
];
