<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Test;
use app\models\TestingUser;
use app\modules\profile\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for TestingUser model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function($rule, $action){
                                return !Yii::$app->user->identity->isAdmin && !Yii::$app->user->isGuest;
                            }
                        ],
                        [
                            'denyCallback' => function($rule, $action){
                                return $this->goHome();
                            }
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ]
            ]
        );
    }

    /**
     * Lists all TestingUser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TestingUser model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if($model->test_id == Test::getTestId('Тест Лири')){
            return $this->render('view_liri', [
                'model' => $this->findModel($id),
            ]); 
        }

        if($model->test_id == Test::getTestId('Методика диагностики СПА К. Роджерса и Р. Даймонда.')){
            return $this->render('view_SPA', [
                'model' => $this->findModel($id),
            ]); 
        }
        
        if($model->test_id == Test::getTestId('Шкала тревоги Спилбергера-Ханина')){
            return $this->render('view_spilberg', [
                'model' => $this->findModel($id),
            ]); 
        }
    }

    /**
     * Finds the TestingUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TestingUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestingUser::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
