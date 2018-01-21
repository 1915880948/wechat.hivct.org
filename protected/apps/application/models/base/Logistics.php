<?php

namespace application\models\base;

use application\models\db\TblLogistics;
use qiqi\core\db\base\QSearch;

/**
 * This is the model class for tableClass "TblLogistics".
 * className Logistics
 * @package application\models\base
 */
class Logistics extends TblLogistics
{
    use QSearch;

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

    /**
     * @param $id
     * @return Logistics|array|null|\yii\db\ActiveRecord
     */
    public static function getLogisitcsInfo($id)
    {
        return self::find()->andWhere(['id'=>$id])->asArray()->one();
    }
}
