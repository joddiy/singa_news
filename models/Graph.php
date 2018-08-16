<?php

namespace app\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%graph}}".
 *
 * @property int $g_id
 * @property int $c_id
 * @property string $predicate
 * @property string $object
 * @property string $add_time
 */
class Graph extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%graph}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id'], 'integer'],
            [['add_time'], 'safe'],
            [['predicate'], 'string', 'max' => 100],
            [['object'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'g_id' => 'G ID',
            'c_id' => 'C ID',
            'predicate' => 'Predicate',
            'object' => 'Object',
            'add_time' => 'Add Time',
        ];
    }

    /**
     * @param $c_name
     * @param $key_words
     * @return array
     * @throws Exception
     */
    public static function getGraph($c_name, $key_words)
    {
        $data = [];
        $params = [
            ':c_name' => $c_name,
        ];
        $sql = <<<EOF
select
  b.c_name as subject,
  a.predicate,
  a.object
from graph a left join company b on a.c_id = b.c_id
where b.c_name = :c_name
EOF;
        if (!empty($key_words)) {
            $sql .= " and a.predicate = :predicate";
            $params[':predicate'] = $key_words;
        }
        $ret = Yii::$app->getDb()->createCommand($sql, $params)->queryAll();

        foreach ($ret as $item) {
            $data[] = $item;
        }
        return $data;
    }

    /**
     * @param $c_name
     * @param $key_words
     * @return array
     * @throws Exception
     */
    public static function getRel($c_name, $key_words)
    {
        $data = [];
        $sql = <<<EOF
select
  distinct a.predicate
from graph a left join company b on a.c_id = b.c_id
where b.c_name = :c_name and a.predicate like :key_word
EOF;
        $ret = Yii::$app->getDb()->createCommand($sql, [
            ':c_name' => $c_name,
            ':key_word' => "%" . $key_words . "%"
        ])->queryAll();
        foreach ($ret as $item) {
            $data[] = $item['predicate'];
        }
        return $data;
    }
}
