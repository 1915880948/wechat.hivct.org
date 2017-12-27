<?php

namespace application\models\base;
use Yii;
use application\models\db\TblExpress ;
use qiqi\core\db\base\QSearch;

/**
 * This is the model class for tableClass "TblExpress".
 * className Express
 * @package application\models\base
 */
class Express extends TblExpress
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

    public function getAllActivateExpress()
    {
        return self::find()
            ->andWhere(['status' => 1])
            ->asArray()
            ->all();
    }

    protected function checkDataValid()
    {
        if(!$this->name){
            $this->addError('title', '快递公司不能为空');
        }
    }

}
