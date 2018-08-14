<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%company}}".
 *
 * @property int $c_id
 * @property string $c_name
 * @property string $add_time
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_time'], 'safe'],
            [['c_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            'c_name' => 'C Name',
            'add_time' => 'Add Time',
        ];
    }

}
