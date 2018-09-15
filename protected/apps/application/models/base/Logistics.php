<?php

namespace application\models\base;

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
        $openids = [
            '99' => 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q',
            '1'  => 'oVP2NjuAQCgTdJaY1uJfLC2_k8Eo',
            '9'  => 'oVP2Njg3lIo5UHwjTL8puckIFyg0',
            '8'  => 'oVP2NjjErppuncBbLsZoqFxKZZ-Y',
            '3'  => 'oVP2NjsJflVooVCY2k-Mq8dHdovw',
            '17' => 'oVP2NjuquxBk6GW2abq-uJzWdxVg',
            '16' => 'oVP2NjuLdxPslsOlNj5bh0e1PTCU',
            '10' => 'oVP2Njg2xN14u4EG9Gnkj2AsFsx8',
            '12' => 'oVP2NjmuSd7bGbAMf0aTpRiknzm4',
            '6'  => 'oVP2NjtOrepxul60ycZWsds_XFMM',
            '19' => 'oVP2NjhjJM0dpAkQchMidubAL-_M',
            '7'  => 'oVP2NjnT1qn25KcNV7YaxhWSwTc4',
            '13' => 'oVP2Nju7_VfS-j2kKQGK8MTwxwu4',
            '4'  => 'oVP2NjtK6BbIoUD2Enn6XIL8s-cI',
        ];
        $refs = [
            '29' => '1',
            '27' => '3',
            '22' => '6',
            '14' => '13',
        ];
        return  ArrayHelper::getValue($openids, $id, ArrayHelper::getValue($openids, $refs[$id] ?? '99'));
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
