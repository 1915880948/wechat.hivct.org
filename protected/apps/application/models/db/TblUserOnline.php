<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_online}}".
 *
 * @property string $openid
 * @property string $token
 * @property string $verify_code
 * @property integer $verify_time
 * @property string $updated_at
 */
class TblUserOnline extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_online}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['verify_time'], 'integer'],
            [['updated_at'], 'safe'],
            [['openid'], 'string', 'max' => 28],
            [['token'], 'string', 'max' => 32],
            [['verify_code'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'openid' => 'Openid',
            'token' => 'Token',
            'verify_code' => 'Verify Code',
            'verify_time' => 'Verify Time',
            'updated_at' => 'Updated At',
        ];
    }
}
