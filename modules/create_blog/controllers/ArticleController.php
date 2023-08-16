<?php

namespace app\modules\create_blog\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Article;
use app\models\CategoryArticle;
use app\modules\create_blog\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $categoryArticleList = CategoryArticle::getCategoryArticleList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryArticleList' => $categoryArticleList,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Article();

        $categoryArticleList = CategoryArticle::getCategoryArticleList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (Yii::$app->request->isPost) {
                    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    if ($model->upload()) {
                        if($model->save(false)){
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                        
                    }
                }        
                
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categoryArticleList' => $categoryArticleList,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categoryArticleList = CategoryArticle::getCategoryArticleList();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->upload()) {
                    if($model->save(false)){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                        
                }
        }

        return $this->render('update', [
            'model' => $model,
            'categoryArticleList' => $categoryArticleList,
        ]);
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
