<?php

use app\models\AnswerUser;
use app\models\CategoryQuestion;
use app\models\Group;
use app\models\Question;
use app\models\StatusTestingUser;
use app\models\Test;
use app\models\TestingUser;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestingUser */

$testName = Test::getTestName($model->test_id);

$this->title = 'Результат прохождения теста';
\yii\web\YiiAsset::register($this);


$key = TestingUser::findOne(['id'=>$model->id])->auth_key;
        
$reactive_plus = CategoryQuestion::getCategoryId('Реактивная тревожность +');
$reactive_plus_result = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $reactive_plus])->sum('answer_value');
        
$reactive_minus = CategoryQuestion::getCategoryId('Реактивная тревожность -');
$reactive_minus_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $reactive_minus])->sum('answer_value');
        
$personal_plus = CategoryQuestion::getCategoryId('Личностная тревожность +');
$personal_plus_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $personal_plus])->sum('answer_value');

$personal_minus = CategoryQuestion::getCategoryId('Личностная тревожность -');
$personal_minus_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $personal_minus])->sum('answer_value');



$reactive = $reactive_plus_result -  $reactive_minus_result + 35;

$personals = $personal_plus_result -  $personal_minus_result + 35;


?>
<div class="testing-user-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К кабинету психолога', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
        </h2>

    

    <div class="card testing-card">
        <div class="card-header">
            Название теста: <?= Html::encode($testName) ?>
        </div>
        <ul class="list-group list-group-flush testing-card">
            <li class="list-group-item testing-card">Дата прохождения: <?= Html::encode(Yii::$app->formatter->asDate( $model->date, 'php:d-m-Y H:i:s')) ?></li>
            <li class="list-group-item testing-card">ФИО: <?= Html::encode($model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic) ?></li>
            <li class="list-group-item testing-card">Группа: <?= Html::encode(Group::getGroupName($model->user->group_id)) ?></li>
            <li class="list-group-item testing-card">Статус: <?= Html::encode(StatusTestingUser::getStatusTestingName($model->status_testing_id)) ?></li>
            <li class="list-group-item testing-card">Результат: 
            <table class="table testing-card">
                <thead>
                    <tr>
                    <th scope="col">Тревожность:</th>
                    <th scope="col">Баллы:</th>
                    <th scope="col">Интерпретация:</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Реактивная(ситуативная) тревожность </th>
                        <td><?= Html::encode($reactive) ?></td>
                        <?php if($reactive >= 45){
                        echo '<td><p class="text-danger">Высокий уровень тревожности.</p></td>';
                        if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                            $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                            $model->save(false);
                        }
                        } elseif($reactive >= 31){
                        echo '<td>Средний уровень тревожности.</td>';
                        } else{
                        echo '<td><p class="text-success">Низкий уровень тревожности.</p></td>';
                        }?>
                    </tr>
                    <tr>
                        <th scope="row">Личностная тревожность </th>
                        <td><?= Html::encode($personals) ?></td>
                        <?php if($personals >= 45){
                        echo '<td><p class="text-danger">Высокий уровень тревожности.</p></td>';
                            if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                $model->save(false);
                            }
                        } elseif($personals >= 31){
                        echo '<td>Средний уровень тревожности.</td>';
                        } else{
                        echo '<td><p class="text-success">Низкий уровень тревожности.</p></td>';
                        }?>
                    </tr>
                </tbody>
                </table>
            </li>
            <li class="list-group-item testing-card">Если Вас что-то беспокоит, рекомендуем обратиться к специалисту.</li>
        </ul>
    </div>


</div>
