<?php

namespace app\controllers;

use app\models\BemModel;
use app\models\Cluster;
use app\models\Company;
use app\models\Graph;
use app\models\News;
use app\models\OSISoft;
use app\models\SignupForm;
use app\models\Type;
use app\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $types = Type::getAllTypes();
        return $this->render('index', [
            'types' => $types
        ]);
    }

    /**
     * Displays result
     *
     * @return string
     */
    public function actionResult()
    {
        try {
            $c_name = $_REQUEST['c_name'];
            $t_name = $_REQUEST['t_name'];
            $day = $_REQUEST['day'];
            $company = Company::findOne(['c_name' => $c_name]);
            // if the company doesn't exist, then search by google
            if (empty($company)) {
                return $this->redirect('https://www.google.com.sg/search?q=' . $c_name);
            }
            $articles = Cluster::getCluster($c_name, $t_name, $day);
            $rel = Graph::getRel($c_name, "");
            return $this->render('result', [
                'c_name' => $c_name,
                't_name' => $t_name,
                'day' => $day,
                'articles' => $articles,
                'rel' => $rel
            ]);
        } catch (\Exception $e) {
            $types = Type::getAllTypes();
            return $this->render('index', [
                'types' => $types
            ]);
        }

    }

    /**
     * Displays text
     *
     * @return string
     */
    public function actionText()
    {
        try {
            $n_id = $_REQUEST['n_id'];
            $article = News::findOne(['n_id' => $n_id]);
            return $this->render('text', [
                'article' => $article
            ]);
        } catch (\Exception $e) {
            $types = Type::getAllTypes();
            return $this->render('index', [
                'types' => $types
            ]);
        }
    }
}
