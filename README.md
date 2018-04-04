# easybaidu 百度ocr接口
laravel 集成百度ocr接口
# 安装
````
composer require xiaoyi/easy-baidu
````

# 设置配置文件
1. 在 `config/app.php` 注册 ServiceProvider 和 Facade

```php
'providers' => [
    // ...
    Xiaoyi\EasyBaidu\Providers\BaiduServiceProvider::class
],
'aliases' => [
    // ...
    'EasyBaidu' => Xiaoyi\EasyBaidu\Facades\EasyBaidu::class
],
```

2、创建配置文件：
````
php artisan vendor:publish --provider="Xiaoyi\EasyBaidu\Providers\BaiduServiceProvider"
````
3. 修改应用根目录下的 `config/baidu.php` 中对应的参数即可。

# 对应方法

1、识别营业执照

```php

调用示例：

$image = 图片资源;
EasyBaidu::license($image);

```

2、识别身份证

```php

调用示例：

$image = 图片资源;
EasyBaidu::idcard($image);

```
2、识别银行卡

```php

调用示例：

$image = 图片资源;
EasyBaidu::bankcard($image);

```