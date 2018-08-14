<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $n_id
 * @property string $n_title
 * @property string $n_path
 * @property int $n_day
 * @property string $add_time
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['n_day'], 'integer'],
            [['add_time'], 'safe'],
            [['n_title', 'n_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'n_id' => 'N ID',
            'n_title' => 'N Title',
            'n_path' => 'N Path',
            'n_day' => 'N Day',
            'add_time' => 'Add Time',
        ];
    }
}
