<?php

return [
    'api' => [
        \Api\middleware\ConnectionDatabase::class,
        \Api\middleware\Authorization::class,
        \Api\middleware\ParameterConverter::class,
    ],
];
