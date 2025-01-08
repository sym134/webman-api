<?php

return [
    'api' => [
        \Api\middleware\Authentication::class,
        \Api\middleware\ParameterConverter::class,
        \Api\middleware\RequestLog::class,
    ],
];
