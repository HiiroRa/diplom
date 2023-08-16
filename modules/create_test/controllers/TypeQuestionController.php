<?php

namespace app\modules\create_test\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\AnswerQuestion;
use app\models\Question;
use app\modules\create_test\models\TypeQuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypeQuestionController implements the CRUD actions for AnswerQuestion model.
 */
class TypeQuestionController extends Controller
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
                                return Yii::$app->user->identity->isPsycho;
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
     * Lists all AnswerQuestion models.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $searchModel = new TypeQuestionSearch(['question_id'=> $id]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $titleQuestion = Question::getTitleQuestion($id);
        $idQuestion = $id;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'titleQuestion' => $titleQuestion,
            'idQuestion' => $idQuestion,
        ]);
    }

    /**
     * Displays a single AnswerQuestion model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AnswerQuestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new AnswerQuestion();
        $questionList = Question::getQuestionList();
        $titleQuestion = Question::getTitleQuestion($id);
        $idQuestion = $id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'questionList' => $questionList,
            'titleQuestion' => $titleQuestion,
            'idQuestion' => $idQuestion,
        ]);
    }

    /**
     * Updates an existing AnswerQuestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $questionList = Question::getQuestionList();
        $idQuestion = $model->question_id;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'questionList' => $questionList,
            'idQuestion' => $idQuestion,
        ]);
    }

    /**
     * Deletes an existing AnswerQuestion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnswerQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AnswerQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnswerQuestion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
