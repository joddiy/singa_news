<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionText()
    {
        for ($i = 1; $i <= 500; $i++) {
            $handle = fopen(\Yii::$app->params['base_dir'] . $i . ".txt", "r");
            if ($handle) {
                $j = 1;
                $str = "";
                $is_first = true;
                while (($line = fgets($handle)) !== false) {
                    if ($is_first) {
                        $is_first = !$is_first;
                        continue;
                    }
                    $str .= " " . $line;
                    $j += 1;
                    if ($j > 5) {
                        $sql = "update news set n_des = :des where n_id = :id";
                        \Yii::$app->getDb()->createCommand($sql, [
                            ":des" => substr($str, 1, 500),
                            ":id" => $i,
                        ])->execute();
                        break;
                    }
                }

                fclose($handle);
            }
        }
    }
}
