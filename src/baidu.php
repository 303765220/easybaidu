<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 17:16
 */
namespace Xiaoyi\EasyBaidu;

use Xiaoyi\EasyBaidu\Exceptions\BaiduException;

require_once 'sdk/AipOcr.php';
class baidu
{

    private $client;

    private $appid;
    private $appkey;
    private $secretkey;


    public function __construct()
    {
        $this->check();
        $this->client = new \AipOcr($this->appid, $this->appkey, $this->secretkey);
    }

    /**
     * 验证必要参数
     */
    private function check()
    {
        if(is_null(config('baidu'))){
            throw new BaiduException('请先执行php artisan vendor:publish --provider="Xiaoyi\EasyBaidu\Providers\BaiduServiceProvider"');
        }

        $this->appid = config('baidu.APP_ID');
        if(empty($this->appid))
        {
            throw new BaiduException('请输入有效APP_ID');
        }
        $this->appkey = config('baidu.API_KEY');
        if(empty($this->appkey))
        {
            throw new BaiduException('请输入有效API_KEY');
        }
        $this->secretkey = config('baidu.SECRET_KEY');
        if(empty($this->secretkey))
        {
            throw new BaiduException('请输入有效SECRET_KEY');
        }
    }


    /**
     *
     * 识别营业执照
     * @param $image 图片资源
     * @return mixed
     * @throws BaiduException
     */
    public function license($image){
        $result = $this->client->businessLicense($image);

        if(array_key_exists('error_code',$result))
        {
            throw new BaiduException("错误码：".$result['error_code']);
        }

        foreach ($result['words_result'] as $k => $v)
        {
            $reset[$k] = $v['words'];
        }
        return $reset;
    }

    /**
     * 识别身份证照片
     * @param $image 图片资源
     * @param string $detect_direction 是否检测图像朝向  true 和 false
     * @param string $detect_risk 是否开启身份证风险类型  true 和 false
     * @return mixed
     * @throws BaiduException
     */
    public function idcard($image,$detect_direction="true",$detect_risk="false")
    {
        $options = array();
        $options["detect_direction"] = $detect_direction;
        $options["detect_risk"] =  $detect_risk;

        $result = $this->client->idcard($image,'front',$options);

        if(array_key_exists('error_code',$result))
        {
            throw new BaiduException("错误码：".$result['error_code']);
        }

        foreach ($result['words_result'] as $k => $v)
        {
            $reset[$k] = $v['words'];
        }

        return $reset;
    }


}