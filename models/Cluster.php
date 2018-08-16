<?php

namespace app\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%cluster}}".
 *
 * @property int $id
 * @property int $group
 * @property int $c_id
 * @property int $t_id
 * @property int $n_id
 * @property string $add_time
 */
class Cluster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cluster}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group', 'c_id', 't_id', 'n_id'], 'integer'],
            [['add_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group' => 'Group',
            'c_id' => 'C ID',
            't_id' => 'T ID',
            'n_id' => 'N ID',
            'add_time' => 'Add Time',
        ];
    }

    /**
     * @param $c_name
     * @param $t_name
     * @param $day
     * @return array
     * @throws Exception
     */
    public static function getCluster($c_name, $t_name, $day)
    {
        $data = [];
        $sql = <<<EOF
select
  a.`group`,
  c.n_title,
  c.n_id,
  c.n_des
from cluster a 
  left join company b on a.c_id = b.c_id
  left join news c on a.n_id = c.n_id
  left join type d on a.t_id = d.t_id
where b.c_name = :c_name and d.t_name = :t_name
      and c.n_day = :n_day
order by a.`group`, c.n_id
EOF;
        $ret = Yii::$app->getDb()->createCommand($sql, [
            ':c_name' => $c_name,
            ':t_name' => $t_name,
            ':n_day' => $day
        ])->queryAll();
        foreach ($ret as $item) {
            if (empty($data[$item['group']])) {
                $data[$item['group']] = [];
            }
            $data[$item['group']][] = $item;
        }
        return $data;

    }
}
