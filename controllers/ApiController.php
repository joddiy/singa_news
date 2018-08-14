<?php
/**
 * author:       joddiyzhang <joddiyzhang@gmail.com>
 * createTime:   11/03/2018 9:23 PM
 * fileName :    ApiController.php
 */

namespace app\controllers;

use app\components\Common;
use app\components\RestController;
use app\components\XMMitalk;
use app\components\XMPassport;
use app\models\AdminLog;
use app\models\AdminToken;
use app\models\AdminUser;
use app\components\XMCas;
use app\models\Company;
use app\models\Graph;
use app\models\LbArchitecture;
use app\models\LbBem;
use app\models\OSISoft;
use Yii;
use yii\base\ErrorException;


/**
 * Class ApiController
 * @package app\controllers
 */
class ApiController extends RestController
{

    /**
     * @return array
     */
    public function actionGetCompanies()
    {
        try {
            $params = Yii::$app->request->get();
            if (empty($params['keyword'])) {
                return $this->formatRestResult(self::SUCCESS, []);
            }
            $key = "%" . $params['keyword'] . "%";
            $sql = <<<EOF
SELECT *
From company
WHERE c_name like :keyword
EOF;
            $ret = Company::getDb()->createCommand($sql, [":keyword" => $key])->queryAll();
            $data = [];
            foreach ($ret as $item) {
                $data[$item['c_name']] = $item;
            }
            return $this->formatRestResult(self::SUCCESS, $ret);
        } catch (\Exception $e) {
            return $this->formatRestResult(self::FAILURE, $e->getMessage());
        }
    }

    public function actionGetGraph()
    {
        try {
            $params = Yii::$app->request->get();
            if (empty($params['c_name'])) {
                return $this->formatRestResult(self::SUCCESS, []);
            }
            $graph = Graph::getGraph($params['c_name'], $params['keyword']);
            return $this->formatRestResult(self::SUCCESS, $graph);
        } catch (\Exception $e) {
            return $this->formatRestResult(self::FAILURE, $e->getMessage());
        }
    }

    public function actionGetRel()
    {
        try {
            $params = Yii::$app->request->get();
            if (empty($params['c_name'])) {
                return $this->formatRestResult(self::SUCCESS, []);
            }
            if (empty($params['keyword'])) {
                $key_word = "";
            } else {
                $key_word = $params['keyword'];
            }
            $rel = Graph::getRel($params['c_name'], $key_word);
            return $this->formatRestResult(self::SUCCESS, $rel);
        } catch (\Exception $e) {
            return $this->formatRestResult(self::FAILURE, $e->getMessage());
        }
    }
}