<?php

namespace application\models\base;

use application\common\base\OpenIds;
use application\models\db\TblLogistics;
use qiqi\core\db\base\QSearch;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for tableClass "TblLogistics".
 * className Logistics
 * @package application\models\base
 */
class Logistics extends TblLogistics
{
    use QSearch;

    /**
     * @param $id
     * @return Logistics|array|null|\yii\db\ActiveRecord
     */
    public static function getLogisitcsInfo($id)
    {
        return self::find()
                   ->andWhere(['id' => $id])
                   ->asArray()
                   ->one();
    }

    public static function getLogisticsOpenId($id)
    {
        // 1	beijing_1	北京-爱易检中心	1	2017-11-21 22:50:48
        // 3	shanxi_1	山西-临汾蓝翔心语	1	2017-11-27 21:55:46
        // 4	shenyang_1	沈阳-阳光工作组彩虹港湾	1	2017-11-27 21:55:58
        // 6	zhejiang_1	浙江-阳光海岸彩虹服务中心	1	2017-11-28 15:45:18
        // 7	henan_1	河南-南阳市心灵港湾工作组	1	2017-11-28 15:45:29
        // 8	hunan_1	湖南-左岸彩虹	1	2017-11-28 15:45:39
        // 9	guangxi_1	广西-广西碧云湖社区	1	2017-11-28 15:45:48
        // 10	hainan_1	海南-三亚明日工作组	1	2017-11-28 15:45:59
        // 11	chongqing_1	重庆-蓝宇工作组	1	2017-11-28 15:46:09
        // 12	sichuan_1	四川-宜宾市蓝梦健康咨询服务中心	1	2017-11-28 15:46:23
        // 13	yunan_1	云南-彩云天空	0	2017-11-28 15:46:43
        // 14	yunan_2	云南-昭通	1	2017-11-28 15:46:55
        // 16	天津	天津-天津艾馨家园	1	2018-02-10 20:59:37
        // 17	哈尔滨	哈尔滨-哈尔滨康乃馨关爱之家	1	2018-02-10 21:08:09
        // 18	xianchang	现场调查检测免押金	1	2018-02-26 23:48:48
        // 19	xinjiang_1	新疆-乌鲁木齐新疆男孩工作组	1	2018-04-15 08:48:55
        // 20	beijing-2	北京-祥云彩虹门诊	0	2018-07-27 05:23:04
        // 22	hangzhou	浙江-杭州爱心工作组	1	2018-07-27 05:25:45
        // 23	zhengzhou	河南-郑州爱之援助	1	2018-07-27 05:26:49
        // 24	qingdao	山东-青岛你我健康	1	2018-07-27 05:27:06
        // 26	wuhan	湖北-武汉馨缘	1	2018-07-30 08:18:44
        // 27	changzhi	山西-长治蓝色港湾	1	2018-07-30 08:23:36
        // 28	fuzhou	福建-福州	1	2018-07-30 10:23:49
        // 29	jingcheng	北京京城彩虹门诊	1	2018-08-01 04:48:26

        $openids = [
            //6Q是gouki,5Q是momo
            '99' => OpenIds::getMomoOpenId(),
            '1'  => 'oVP2NjuAQCgTdJaY1uJfLC2_k8Eo',
            '9'  => 'oVP2Njg3lIo5UHwjTL8puckIFyg0',
            '8'  => 'oVP2NjjErppuncBbLsZoqFxKZZ-Y',
            '3'  => 'oVP2NjsJflVooVCY2k-Mq8dHdovw',
            //两个杭州的
            '6'  => 'oVP2NjtOrepxul60ycZWsds_XFMM',
            '22' => 'oVP2Njpq8BHZ2oV7dId4940OmyAY',
            //
            '17' => 'oVP2NjuquxBk6GW2abq-uJzWdxVg',
            '16' => 'oVP2NjuLdxPslsOlNj5bh0e1PTCU',
            '10' => 'oVP2Njg2xN14u4EG9Gnkj2AsFsx8',
            '12' => 'oVP2NjmuSd7bGbAMf0aTpRiknzm4',

            '19' => 'oVP2NjhjJM0dpAkQchMidubAL-_M',
            '7'  => 'oVP2NjnT1qn25KcNV7YaxhWSwTc4',
            '13' => 'oVP2Nju7_VfS-j2kKQGK8MTwxwu4',
            '4'  => 'oVP2NjtK6BbIoUD2Enn6XIL8s-cI',
            '26' => ['oVP2Njqsjkf-KxKAFaqffP8Le0qM','oVP2NjsDgCjqfHSVP1avbPO3ZYrQ'],
            //郑州
            '23' => 'oVP2Njt7eMvVx40kQi06Sy9XjrHU'

        ];
        $refs = [
            '29' => '1',
            '27' => '3',
            // '22' => '6',
            '14' => '13',
        ];
        return ArrayHelper::getValue($openids, $id, ArrayHelper::getValue($openids, $refs[$id] ?? '99'));
    }

    /**
     * @param $datas
     * @return bool
     */
    public function create($datas)
    {
        $this->load($datas);
        $this->checkDataValid();
        if($this->validate(null, false) && $this->save()){
            return true;
        }
        return false;
    }

    /**
     * @return Logistics[]|array|\yii\db\ActiveRecord[]
     */
    public function getAllActivateLogistics()
    {
        return self::find()
                   ->andWhere(['status' => 1])
                   ->asArray()
                   ->all();
    }

    protected function checkDataValid()
    {
        if(!$this->title){
            $this->addError('title', '发货地不能为空');
        }
    }
}
