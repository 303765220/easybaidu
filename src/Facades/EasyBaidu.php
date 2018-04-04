<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 9:30
 */

namespace Xiaoyi\EasyBaidu\Facades;

use Illuminate\Support\Facades\Facade;

class EasyBaidu extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'baidu';
    }
}