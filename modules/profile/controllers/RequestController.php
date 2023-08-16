<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Request;
use app\models\StatusRequest;
use app\modules\profile\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $statusRequestList = StatusRequest::getStatusRequestList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusRequestList' => $statusRequestList,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param int $id Номер обращения
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $statusRequestList = StatusRequest::getStatusRequestList();
        if($model->test_response){
            $model->status_request_id = StatusRequest::getStatusRequestId('Просмотрено');
            $model->save(false);
        }
        

        return $this->render('view', [
            'model' => $this->findModel($id),
            'statusRequestList' => $statusRequestList,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Номер обращения
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Номер обращения
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
