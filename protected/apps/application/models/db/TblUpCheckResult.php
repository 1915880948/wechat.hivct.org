<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%up_check_result}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $check_doctor
 * @property string $check_desc
 * @property integer $adis_result
 * @property integer $syphilis_result
 * @property integer $hepatitis_b_result
 * @property integer $hepatitis_c_result
 * @property integer $is_check
 * @property string $created_at
 * @property string $updated_at
 */
class TblUpCheckResult extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%up_check_result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'adis_result', 'syphilis_result', 'hepatitis_b_result', 'hepatitis_c_result', 'is_check'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['phone', 'email', 'check_doctor'], 'string', 'max' => 20],
            [['check_desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '用户id',
            'name' => '被检测人',
            'phone' => '电话',
            'email' => 'Email',
            'check_doctor' => '检测医生',
            'check_desc' => '检测描述',
            'adis_result' => '艾滋病检测结果:1阴性，2：阳性',
            'syphilis_result' => '梅毒检测结果:1阴性，2：阳性',
            'hepatitis_b_result' => '乙肝检测结果:1阴性，2：阳性',
            'hepatitis_c_result' => '丙肝检测结果:1阴性，2：阳性',
            'is_check' => '是否检测 0：否（默认），1:是',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
