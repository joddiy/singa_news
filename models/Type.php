<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%type}}".
 *
 * @property int $t_id
 * @property string $t_name
 * @property string $add_time
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_time'], 'safe'],
            [['t_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            't_id' => 'T ID',
            't_name' => 'T Name',
            'add_time' => 'Add Time',
        ];
    }

    public static function getAllTypes()
    {
        $ret = self::find()->all();
        $data = [];
        foreach ($ret as $item) {
            $data[$item['t_id']] = $item['t_name'];
        }
        return $data;
    }
}
