<?php

namespace application\models\base;

use application\models\db\TblReagent;
use qiqi\core\db\base\QSearch;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for tableClass "TblReagent".
 * className Reagent
 * @package application\models\base
 * @property array $types
 */
class Reagent extends TblReagent
{
    use QSearch;
    const TYPE_FREE = 'free';
    const TYPE_GIFT = 'gift';
    const TYPE_CHARGE = 'charge';
    /**
     * @var array
     */
    private static $_options = [
        self::TYPE_FREE   => '免费试剂',
        self::TYPE_GIFT   => '免费赠品',
        self::TYPE_CHARGE => '付费试剂',
    ];

    /**
     * 返回所有的ReAgent
     * @return array|\yii\db\ActiveRecord[]|Reagent[]
     */
    public static function getFrontAll()
    {
        return self::find()
                   ->andWhere(['status' => 1])
                   ->all();
    }

    public static function all()
    {
        return self::find()
                   ->asArray()
                   ->all();
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'type'   => '商品类型',
            'status' => '状态',
            'image'  => '商品图片'
        ]);
    }

    public function getTypeName($type)
    {
        return ArrayHelper::getValue(self::$_options, $type, "");
    }

    public function getTypes()
    {
        return self::$_options;
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

    protected function checkDataValid()
    {
        if(!$this->name){
            $this->addError('name', '名称不能为空');
        }
        if(!$this->price){
            $this->price = 0;
        }
        if(!$this->stock){
            $this->stock = -1;
        }
    }
}
