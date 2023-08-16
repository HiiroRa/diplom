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
        
$authoriterian = CategoryQuestion::getCategoryId('Авторитарный');
$authoriterian_result = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $authoriterian])->sum('answer_value');
        
$egocentric = CategoryQuestion::getCategoryId('Эгоистичный');
$egocentric_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $egocentric])->sum('answer_value');
        
$agressive = CategoryQuestion::getCategoryId('Агрессивный');
$agressive_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $agressive])->sum('answer_value');

$suspicios = CategoryQuestion::getCategoryId('Подозрительный');
$suspicios_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $suspicios])->sum('answer_value');

$subordinate  = CategoryQuestion::getCategoryId('Подчиняемый');
$subordinate_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $subordinate])->sum('answer_value');

$dependent = CategoryQuestion::getCategoryId('Зависимый');
$dependent_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $dependent])->sum('answer_value');

$friendly = CategoryQuestion::getCategoryId('Дружелюбный');
$friendly_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $friendly])->sum('answer_value');

$altruistic = CategoryQuestion::getCategoryId('Альтруистический');
$altruistic_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $altruistic])->sum('answer_value'); 


$factor_dominamce = ($authoriterian_result - $subordinate_result) + 0.7 * ($altruistic_result + $egocentric_result - $suspicios_result - $dependent_result) ;

$factor_frendliness = ($friendly_result - $agressive_result) + 0.7*($altruistic_result - $egocentric_result - $suspicios_result + $dependent_result) ;


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
                        <th scope="col">Основной фактор:</th>
                        <th scope="col">Баллы:</th>
                        <th scope="col">Результат:</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                        <th scope="row">Доминирование</th>
                        <td><?= Html::encode($factor_dominamce) ?></td>
                        <?php if($factor_dominamce >= 13){
                            echo '<td>Возможно патологическое поведение</td>';
                            if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                $model->save(false);
                            }
                        } elseif($factor_dominamce >= 9){
                            echo '<td>Возможно экстремальное поведение</td>';
                            if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                $model->status_testing_id = StatusTestingUser::getStatusTestingId('Экстремальное');
                                $model->save(false);
                            }
                        } else{
                            echo '<td>Адаптивное поведение</td>';
                        }?>
                        </tr>
                        <tr>
                        <th scope="row">Дружелюбие</th>
                        <td><?= Html::encode($factor_frendliness) ?></td>
                        <?php if($factor_dominamce >= 13){
                            echo '<td>Возможно патологическое поведение</td>';
                            if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                $model->save(false);
                            }
                        } elseif($factor_dominamce >= 9){
                            echo '<td>Возможно экстремальное поведение</td>';
                            if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                $model->status_testing_id = StatusTestingUser::getStatusTestingId('Экстремальное');
                                $model->save(false);
                            }
                        } else{
                            echo '<td>Адаптивное поведение</td>';
                        }?>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                        <th scope="col">Типы межличностных отношений:</th>
                        <th scope="col">Баллы:</th>
                        <th scope="col">Интерпретация:</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th scope="row"> Властный-лидирующий </th>
                            <td><?= Html::encode($authoriterian_result) ?></td>
                            <?php if($authoriterian_result >= 13){
                            echo '<td>Дидактический стиль высказываний, императивная потребность командовать другими, черты деспотизма</td>';
                            } elseif($authoriterian_result >= 9){
                            echo '<td>Нетерпимость к критике, переоценка собственных возможностей.</td>';
                            } else{
                            echo '<td>Уверенность в себе, умение быть хорошим наставником и организатором, свойства руководителя.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"> Независимый-доминирующий</th>
                            <td><?= Html::encode($egocentric_result) ?></td>
                            <?php if($egocentric_result >= 13){
                                echo '<td>Тенденция иметь особое мнение, отличное от мнения большинства, и занимать обособленную позицию в группе.</td>';
                            } elseif($egocentric_result >= 9){
                                echo '<td>Самодовольный, нарциссический, с выраженным чувством собственного превосходства над окружающими.</td>';
                            } else{
                                echo '<td>Уверенный, независимый и соперничающий.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">
                            Прямолинейный-агрессивный </th>
                            <td><?= Html::encode($agressive_result) ?></td>
                            <?php if($agressive_result >= 13){
                            echo '<td>Несдержанность и вспыльчивость.</td>';
                            } elseif($agressive_result >= 9){
                            echo '<td>Чрезмерное упорство и недружелюбие.</td>';
                            } else{
                            echo '<td>Настойчивость в достижении цели.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"> Недоверчивый-скептический </th>
                            <td><?= Html::encode($suspicios_result) ?></td>
                            <?php if($suspicios_result >= 13){
                            echo '<td>Недовольство окружающими и подозрительность.</td>';
                            } elseif($suspicios_result >= 9){
                            echo '<td>Обидчивое и недоверчивое отношение к окружающим с выраженной склонностью к критицизму.</td>';
                            } else{
                            echo '<td>Реалистичность базы суждений и поступков, скептицизм и неконформность.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"> Покорно-застенчивый </th>
                            <td><?= Html::encode($subordinate_result) ?></td>
                            <?php if($subordinate_result >= 13){
                            echo '<td>Полная покорность, повышенное чувство вины, самоуничижение.</td>';
                            } elseif($subordinate_result >= 9){
                            echo '<td>Склонность брать на себя чужие обязанности.</td>';
                            } else{
                            echo '<td>Возможная скромность и застенчивость.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"> Зависимый-послушный </th>
                            <td><?= Html::encode($dependent_result) ?></td>
                            <?php if($dependent_result >= 13){
                            echo '<td>Полная зависимость от мнения окружающих и сверхконформность.</td>';
                            } elseif($dependent_result >= 9){
                            echo '<td>Потребность в помощи со стороны окружающих и в их признании.</td>';
                            } else{
                            echo '<td>Потребность в доверии со стороны окружающих.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"> Сотрудничающий-конвенциальный </th>
                            <td><?= Html::encode($friendly_result ) ?></td>
                            <?php if($friendly_result  >= 13){
                            echo '<td>Стремление подчеркнуть свою причастность к интересам большинства.</td>';
                            } elseif($friendly_result >= 9){
                            echo '<td> Компромиссное поведение, несдержанность в излияниях своего дружелюбия по отношению к окружающим.</td>';
                            } else{
                            echo '<td>Стремление к тесному сотрудничеству с референтной группой, дружелюбное отношение с окружающими.</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"> Ответственно-великодушный </th>
                            <td><?= Html::encode($altruistic_result) ?></td>
                            <?php if($altruistic_result >= 13){
                            echo '<td>Подчеркнутый альтруизм.</td>';
                            } elseif($altruistic_result >= 9){
                            echo '<td>Мягкосердечность, сверхобязательность, гиперсоциальность установок.</td>';
                            } else{
                            echo '<td>Выраженная готовность помогать окружающим, развитое чувство ответственности.</td>';
                            }?>
                        </tr>
                    </tbody>
                </table>
            </li>
            <li class="list-group-item testing-card">Если Вас что-то беспокоит, рекомендуем обратиться к специалисту.</li>
        </ul>
    </div>


</div>
