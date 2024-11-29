<?php

return [
    'api' => [
        \jizhi\api\middleware\ConnectionDatabase::class,
        \jizhi\api\middleware\ApiAuthMiddleware::class,
        \jizhi\api\middleware\ParameterConverterMiddleware::class,
    ],
];
