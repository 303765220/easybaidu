<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 17:16
 */
namespace Xiaoyi\EasyBaidu\Libs;


use Xiaoyi\EasyBaidu\Exceptions\BaiduException;

include  __DIR__.'/../sdk/AipOcr.php';
class ocr
{
    private $client;

    private $appid;
    private $appkey;
    private $secretkey;

    public function __construct()
    {
        if(is_null(config('baidu'))){
            throw new BaiduException('请先执行php artisan vendor:publish --provider="Xiaoyi\EasyBaidu\Providers\BaiduServiceProvider"');
        }
        $this->appid = config('baidu.APP_ID');
        $this->appkey = config('baidu.API_KEY');
        $this->secretkey = config('baidu.SECRET_KEY');
        $this->client = new \AipOcr($this->appid, $this->appkey, $this->secretkey);
    }


    /**
     * 识别营业执照
     * @param $image 图片资源
     * @return mixed
     * @throws BaiduException
     */
    public function license($image){
        $result = $this->client->businessLicense($image);
        return $this->formatResult($result);
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
        return $this->formatResult($result);
    }


    /**
     * 识别银行卡照片
     * @param $image
     * @return mixed
     * @throws BaiduException
     */
    public function bankcard($image)
    {
        $result = $this->client->bankcard($image);
        if(array_key_exists('error_code',$result))
        {
            throw new BaiduException("错误码：".$result['error_code']);
        }
        return $result['result'];
    }



    /**
     * 格式化返回数据
     */
    private function formatResult($result)
    {
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