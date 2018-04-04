<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 17:47
 */
namespace Xiaoyi\EasyBaidu\Providers;

use Illuminate\Support\ServiceProvider;
use Xiaoyi\EasyBaidu\baidu;

class BaiduServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/baidu.php' => config_path('baidu.php'), // 发布配置文件到 laravel 的config 下
        ]);
    }

    public function register()
    {
        $this->app->singleton('baidu', function () {
            return new baidu();
        });
    }
}