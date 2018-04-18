<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 17:16
 */
namespace Xiaoyi\EasyBaidu;

use Xiaoyi\EasyBaidu\Libs\location;
use Xiaoyi\EasyBaidu\Libs\ocr;

class baidu
{

    /**
     * 识别营业执照
     * @param $image 图片资源
     * @return mixed
     * @throws Exceptions\BaiduException
     */
    public function license($image){
        $model = new ocr();
        return $model->license($image);
    }

    /**
     *
     * 识别身份证照片
     * @param $image 图片资源
     * @param string $detect_direction 是否检测图像朝向  true 和 false
     * @param string $detect_risk 是否开启身份证风险类型  true 和 false
     * @return mixed
     * @throws Exceptions\BaiduException
     */
    public function idcard($image,$detect_direction="true",$detect_risk="false")
    {
        $model = new ocr();
        return $model->idcard($image,$detect_direction="true",$detect_risk="false");
    }


    /**
     * 识别银行卡照片
     * @param $image 图片资源
     * @return mixed
     * @throws Exceptions\BaiduException
     */
    public function bankcard($image)
    {
        $model = new ocr();
        return $model->bankcard($image);
    }

    /**
     * 经纬度转换省市区
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array
     * @throws Exceptions\BaiduException
     */
    public function locationToAddress($lat=30.209435,$lng=120.195667)
    {
        $model = new location();
        return $model->locationToAddress($lat,$lng);
    }
}