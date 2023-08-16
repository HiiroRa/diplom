<?php

namespace app\modules\testing\controllers;

use app\models\AnswerQuestion;
use app\models\AnswerUser;
use app\models\CategoryTest;
use app\models\Question;
use app\models\StatusTestingUser;
use app\models\Test;
use app\models\TestingUser;
use app\modules\testing\models\TestSearch;
use Yii;
use yii\bootstrap5\Html;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Test models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $categoryList = CategoryTest::getCategoryTestList();
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryList' => $categoryList
        ]);
    }



    /**
     * Displays a single Test model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $post = $this->request->post();
        $session = Yii::$app->session;
        // VarDumper::dump($post, 10, true); 
        // VarDumper::dump($session->isActive, 10, true); die;
        $testId = $id;
        $testTitle = Test::getTestName($testId);

        $modelAnswerUser = new AnswerUser();

        $questionsTest = Test::getQuestionsTest($testId);
        $countQuestions = Test::getQuestionsCount($testId);

        $randomString = Yii::$app->request->post('randomString');
       


        if(isset($post['AnswerUser'])){
            
            $current_question = $post['AnswerUser']['question_id'] + 1;

            $questionId = $post['AnswerUser']['question_id']; 
            
            $modelAnswerUser->question_id = $session['questionList'][$questionId] ;
            $modelAnswerUser->answer_value =  $post['AnswerUser']['answer_value'] ;
            $modelAnswerUser->auth_key =  $post['AnswerUser']['auth_key'];
            $modelAnswerUser ->save();

        } else {
            $current_question = Yii::$app->request->post('question_id');
        }
            $session = Yii::$app->session;
            $questionList = [];

            $counter = 1;

        if($current_question <= $countQuestions ){

            foreach($questionsTest as $question){
                
                $questionList [$counter] = $question['id'];
                $counter ++;
                
            }

            $session->set('questionList', $questionList);

            $questionTitle = Question::findOne($questionList[$current_question])->title;
            $questionId = Question::findOne($questionList[$current_question])->id;

            $answers = AnswerQuestion::find()->select(['title'])->where(['question_id'=>$questionList[$current_question]])->indexBy('value')->column();
        }
        else{
            $testingUser = new TestingUser();
            $testingUser->test_id = $id;
            $testingUser->user_id = Yii::$app->user->id;
            $testingUser->auth_key = $post['AnswerUser']['auth_key'];
            $testingUser->status_testing_id = StatusTestingUser::getStatusTestingId('Адаптивный');
            $testingUser->save();
            return $this->redirect('end');
        }

        return $this->render('view', [
            'model' => $this->findModel($testId),
            'testId' => $testId,
            'testTitle' => $testTitle,
            'questionTitle' => $questionTitle,
            'questionId' => $questionId,
            'modelAnswerUser' => $modelAnswerUser,
            'answers' => $answers, 
            'current_question' => $current_question,
            'randomString' => $randomString,
            'countQuestions' => $countQuestions,
        ]);
    }

    public function actionEnd()
    {

        return $this->render('end');
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
