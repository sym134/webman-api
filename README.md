jizhi-webman-api
==================
简单api token使用shopwwi的包修改

支持请求post\get驼峰转下划线

支持响应下划线自动转驼峰

### 安装
```shell
    composer require jizhi/webman-api
```

### 安装请求记录表
```bash
php webman api:install
```

### 配置auth config/plugin/jizhi/auth/app.php

```php
 return [
      // ........
     'guard' => [
         // 添加 api
         'api' => [
             'key' => 'id',
             'field' => ['id','name','email','mobile'], //设置允许写入扩展中的字段
             'num' => 0, //-1为不限制终端数量 0为只支持一个终端在线 大于0为同一账号同终端支持数量 建议设置为1 则同一账号同终端在线1个
             'model'=> User::class
         ]
     ],
    // ........
```

### .env配置
```dotenv
#sql打印
API_SQL_MONITOR_ENABLE=true
#请求日志
API_REQUEST_LOG_ENABLE=true
# 请求换下划线
API_CONVERT_REQUEST_NAME_ENABLE=false
# 响应转驼峰
API_CONVERT_RESPONSE_NAME_ENABLE=false
```