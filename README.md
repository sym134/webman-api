jizhi-api-webman
==================
简单api
token使用shopwwi的包
支持请求post\get驼峰转下划线
支持响应下划线自动转驼峰

### 安装
```shell
    composer require jizhi/api-webman
```


### 配置auth config/plugin/shopwwi/auth/app.php

```php
 return [
      // ........
     'guard' => [
         // 添加 admin
         'api' => [
             'key' => 'id',
             'field' => ['id','name','email','mobile'], //设置允许写入扩展中的字段
             'num' => 0, //-1为不限制终端数量 0为只支持一个终端在线 大于0为同一账号同终端支持数量 建议设置为1 则同一账号同终端在线1个
             'model'=> User::class
         ]
     ],
    // ........
```
