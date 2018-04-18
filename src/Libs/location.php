<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 17:16
 */
namespace Xiaoyi\EasyBaidu\Libs;

use Xiaoyi\EasyBaidu\Exceptions\BaiduException;

class location
{

    private $ak;

    public function __construct()
    {
        $this->ak = config('baidu.APKEY');
    }


    /**
     * 转换CPS坐标系为百度坐标系
     * @param $lng
     * @param $lat
     * @return array
     * @throws BaiduException
     */
    private function formatLocation($lng,$lat)
    {
        $formatUrl = "http://api.map.baidu.com/geoconv/v1/?coords=".$lng.",".$lat."&from=1&to=5&ak=".$this->ak;//将GPS坐标转换为百度坐标系
        $result = json_decode(file_get_contents($formatUrl),true);

        if($result['status'] == "0")
        {
            return array(
                'lat' => $result['result'][0]['y'],
                'lng' => $result['result'][0]['x'],
            );
        }else{
            throw new BaiduException($result['message']);
        }
    }


    /**
     * 经纬度转换省市区
     * @param float $lat
     * @param float $lng
     * @return array
     * @throws BaiduException
     */
    public function locationToAddress($lat=30.209435,$lng=120.195667)
    {
        $formatData = $this->formatLocation($lng,$lat);

        $formatLat = $formatData['lat'];
        $formatLng = $formatData['lng'];
        $url = "http://api.map.baidu.com/geocoder/v2/?location=".$formatLat.",".$formatLng."&output=json&pois=0&ak=".$this->ak;
        $result = json_decode(file_get_contents($url),true);

        if($result['status'] == "0")
        {
            return array(
                'province' => $result['result']['addressComponent']['province'],
                'city' => $result['result']['addressComponent']['city'],
                'district' => $result['result']['addressComponent']['district'],
                'code' => $result['result']['addressComponent']['adcode']
            );
        }else{
            throw new BaiduException($result['message']);
        }
    }
}