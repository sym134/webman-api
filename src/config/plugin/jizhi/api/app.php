<?php
return [
    'enable' => true,
    'sql_monitor_enable' => env('API_SQL_MONITOR_ENABLE', false),
    // 启用转换请求参数中的下划线命名转换为驼峰命名
    'convert_request_name_enable' => env('API_CONVERT_REQUEST_NAME_ENABLE', true),

    // 启用将参数名称的驼峰命名转换为下划线命名
    'convert_response_name_enable' => env('API_CONVERT_RESPONSE_NAME_ENABLE', false),

    // 启用请求日志记录
    'request_log' => [
        'enable' => env('API_REQUEST_LOG_ENABLE', false),
    ],
];
