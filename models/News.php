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

    /**
     * @param $c_name
     * @param $t_type
     * @return array
     * @throws \yii\db\Exception
     */
    public static function getDay($c_name, $t_type)
    {

        $data = [];
        $sql = <<<EOF
select distinct d.n_day
from cluster a left join company b on a.c_id = b.c_id
  left join type c on a.t_id = c.t_id
  left join news d on a.n_id = d.n_id
where b.c_name = :c_name and t_name = :t_type and d.n_id is not null
order by d.n_day
EOF;
        $ret = Yii::$app->getDb()->createCommand($sql, [
            ':c_name' => $c_name,
            ':t_type' => $t_type,
        ])->queryAll();
        foreach ($ret as $item) {
            $data[] = $item['n_day'];
        }
        return $data;

    }
}
