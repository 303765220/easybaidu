<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 17:17
 */

namespace App\Service\Vendor\Baidu;
require dirname(__FILE__) . '/AipOcr.php';

class BaiduService
{

    private $client;
    const APP_ID = '10692773';
    const API_KEY = 'KbPkFTZY1ctCBFV0tGlNvAup';
    const SECRET_KEY = 'dyuD1n8nInA4ufZQRh1FOIYkS7osHgZY';


    public function __construct()
    {
        $this->client = new \AipOcr(self::APP_ID, self::API_KEY, self::SECRET_KEY);
    }


    /**
     * 营业执照识别
     * @param $image 图片资源
     * @return mixed
     */
    public function wenzi($image)
    {
        $image = file_get_contents('https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1522411969097&di=afac2d15cf83e373a425fc410be1191b&imgtype=0&src=http%3A%2F%2Fdocs.ebdoor.com%2FImage%2FCompanyCertificate%2F22%2F229544.JPG');
        $result = $this->client->businessLicense($image);

        foreach ($result['words_result'] as $k => $v)
        {
            $reset[$k] = $v['words'];
        }

        return $reset;
    }


}