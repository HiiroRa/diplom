<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Group;
use app\models\Role;
use app\models\User;
use app\modules\admin\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                                return Yii::$app->user->identity->isAdmin;
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
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $roleList = Role::getRoleList();
        $groupList = Group::getGroupList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roleList' => $roleList,
            'groupList' => $groupList,
        ]);
    }

    public function actionAppoint($id)
    {

        $model = $this->findModel($id);
        $model->role_id = Role::getRoleId('admin');
        $model->group_id = '';
        $model->save(false);

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $roleList = Role::getRoleList();
        $groupList = Group::getGroupList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roleList' => $roleList,
            'groupList' => $groupList,
        ]);
    }

    public function actionPsycho($id)
    {

        $model = $this->findModel($id);
        $model->role_id = Role::getRoleId('psychologist');
        $model->group_id = '';
        $model->save(false);

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $roleList = Role::getRoleList();
        $groupList = Group::getGroupList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roleList' => $roleList,
            'groupList' => $groupList,
        ]);
    }


    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
