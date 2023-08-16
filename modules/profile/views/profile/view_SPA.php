<?php

use app\models\AnswerUser;
use app\models\CategoryQuestion;
use app\models\Question;
use app\models\StatusTestingUser;
use app\models\Test;
use app\models\TestingUser;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestingUser */

$testName = Test::getTestName($model->test_id);

$this->title = 'Результат прохождения теста';
\yii\web\YiiAsset::register($this);


$key = TestingUser::findOne(['id'=>$model->id])->auth_key;
        
$adaptability = CategoryQuestion::getCategoryId('Адаптивность');
$maladaptivity = CategoryQuestion::getCategoryId('Дезадаптивность');
$adaptability_result = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $adaptability])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $adaptability])->sum('answer_value');
$maladaptivity_result = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $maladaptivity])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $maladaptivity])->sum('answer_value');
$adap_maladap = $adaptability_result/($adaptability_result+$maladaptivity_result) * 100;
 

$deceit = CategoryQuestion::getCategoryId('Лживость -');
$deceit1 = CategoryQuestion::getCategoryId('Лживость +');
$deceit_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $deceit])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $deceit])->sum('answer_value');
$deceit1_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $deceit1])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $deceit1])->sum('answer_value');
$deceit_deceit1  = $deceit_result + $deceit1_result;
  

$selfacceptance  = CategoryQuestion::getCategoryId('Принятие себя');
$selfrejection  = CategoryQuestion::getCategoryId('Непринятие себя');
$selfacceptance_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $selfacceptance ])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $selfacceptance ])->sum('answer_value');
$selfrejection_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $selfrejection])->sum('answer_value')
+ AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $selfrejection])->sum('answer_value');
$selfacceptance_selfrejection  = $selfacceptance / ($selfacceptance + $selfrejection) * 100;


$acceptance  = CategoryQuestion::getCategoryId('Принятие других');
$rejection  = CategoryQuestion::getCategoryId('Непринятие других');
$acceptance_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $acceptance])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $acceptance])->sum('answer_value');
$rejection_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $rejection])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $rejection])->sum('answer_value');
$acceptance_rejection  = 1.2*$acceptance_result / (1.2*$acceptance_result + $rejection_result) * 100;


$emoconfort = CategoryQuestion::getCategoryId('Эмоциональный комфорт');
$emodiscomf  = CategoryQuestion::getCategoryId('Эмоциональный дискомфорт');
$emoconfort_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $emoconfort])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $emoconfort])->sum('answer_value');
$emodiscomf_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $emodiscomf])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $emodiscomf])->sum('answer_value');
$emoconfor_emodiscomf  = $emoconfort_result / ($emoconfort_result + $emodiscomf_result) * 100;

$intercontrol = CategoryQuestion::getCategoryId('Внутренний контроль');
$extercontrol = CategoryQuestion::getCategoryId('Внешний контроль');
$intercontrol_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $intercontrol])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $intercontrol])->sum('answer_value');
$extercontrol_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $extercontrol])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $extercontrol])->sum('answer_value');
$intercontrol_extercontrol  = $intercontrol_result / ($intercontrol_result + 1.4*$extercontrol_result) * 100;


$dominance = CategoryQuestion::getCategoryId('Доминирование');
$statement = CategoryQuestion::getCategoryId('Ведомость');
$dominance_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $dominance])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $dominance])->sum('answer_value');
$statement_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $statement])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $statement])->sum('answer_value'); 
$dominance_statement = 2*$dominance_result / (2*$dominance_result + $statement_result) * 100;  

$escapism= CategoryQuestion::getCategoryId('Эскапизм');
$escapism_result  = AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'category_question_id' => $escapism])->sum('answer_value') + AnswerUser::find()->joinWith('question')->where(['auth_key'=>$key, 'additional_category_question' => $escapism])->sum('answer_value'); 

?>
<div class="testing-user-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К личному кабинету', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
        </h2>

    

    <div class="card testing-card">
        <div class="card-header testing-card">
            Название теста: <?= Html::encode($testName) ?>
        </div>
        <ul class="list-group list-group-flush testing-card">
            <li class="list-group-item testing-card">Дата прохождения: <?= Html::encode(Yii::$app->formatter->asDate( $model->date, 'php:d-m-Y H:i:s')) ?></li>
            <li class="list-group-item testing-card">Результат: 
                <table class="table testing-card">
                    <thead>
                        <tr>
                        <th scope="col">Показатель:</th>
                        <th scope="col">Баллы:</th>
                        <th scope="col">Интерпретация:</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th scope="row">Адаптивность</th>
                            <td><?= Html::encode($adaptability_result) ?></td>
                            <?php if($adaptability_result >= 137){
                                echo '<td>Высокий результат</td>';
                            } elseif($adaptability_result >= 68){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Черезвычайно низкий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Дезадаптивность</th>
                            <td><?= Html::encode($maladaptivity_result) ?></td>
                            <?php if($maladaptivity_result >= 137){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($maladaptivity_result >= 68){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"><p class="text-primary">Интегральный показатель адаптации</p></th>
                            <td><?= Html::encode(round($adap_maladap, 0)) ?></td>
                            <?php if($adap_maladap  >= 61){
                                echo '<td>Высокий уровень</td>';

                            } elseif($adap_maladap >= 40){
                                echo '<td>Средний уровень</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Низкий уровень</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Принятие себя</th>
                            <td><?= Html::encode($selfacceptance_result) ?></td>
                            <?php if($selfacceptance_result >= 43){
                                echo '<td>Высокий результат</td>';
                            } elseif($selfacceptance_result >= 14){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Черезвычайно низкий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Непринятие себя</th>
                            <td><?= Html::encode($selfrejection_result) ?></td>
                            <?php if($selfrejection_result >= 29){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($selfrejection_result >= 14){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"><p class="text-primary">Интегральный показатель самопринятия</p></th>
                            <td><?= Html::encode(round($selfacceptance_selfrejection, 0) ) ?></td>
                            <?php if($selfacceptance_selfrejection >= 61){
                                echo '<td>Высокий уровень</td>';

                            } elseif($selfacceptance_selfrejection >= 40){
                                echo '<td>Средний уровень</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Низкий уровень</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Принятие других</th>
                            <td><?= Html::encode($acceptance_result) ?></td>
                            <?php if($acceptance_result >= 25){
                                echo '<td>Высокий результат</td>';
                            } elseif($acceptance_result >= 12){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Черезвычайно низкий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Непринятие других</th>
                            <td><?= Html::encode($rejection_result) ?></td>
                            <?php if($rejection_result >= 29){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($rejection_result >= 14){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"><p class="text-primary">Интегральный показатель принятия других</p></th>
                            <td><?= Html::encode(round($acceptance_rejection, 0) ) ?></td>
                            <?php if($acceptance_rejection >= 61){
                                echo '<td>Высокий уровень</td>';

                            } elseif($acceptance_rejection >= 40){
                                echo '<td>Средний уровень</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Низкий уровень</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Эмоциональный комфорт</th>
                            <td><?= Html::encode($emoconfort_result) ?></td>
                            <?php if($emoconfort_result >= 29){
                                echo '<td>Высокий результат</td>';
                            } elseif($emoconfort_result >= 14){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Черезвычайно низкий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Эмоциональный дискомфорт</th>
                            <td><?= Html::encode($emodiscomf_result) ?></td>
                            <?php if($emodiscomf_result >= 29){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($emodiscomf_result >= 13){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"><p class="text-primary">Интегральный показатель эмоциональной комфортности</p></th>
                            <td><?= Html::encode(round($emoconfor_emodiscomf, 0) ) ?></td>
                            <?php if($emoconfor_emodiscomf >= 61){
                                echo '<td>Высокий уровень</td>';

                            } elseif($emoconfor_emodiscomf >= 40){
                                echo '<td>Средний уровень</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Низкий уровень</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Внутренний контроль</th>
                            <td><?= Html::encode($intercontrol_result) ?></td>
                            <?php if($intercontrol_result >= 53){
                                echo '<td>Высокий результат</td>';
                            } elseif($intercontrol_result >= 26){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Черезвычайно низкий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Внешний контроль</th>
                            <td><?= Html::encode($extercontrol_result) ?></td>
                            <?php if($extercontrol_result >= 37){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($extercontrol_result >= 18){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"><p class="text-primary">Интегральный показатель эмоциональной интернальности</p></th>
                            <td><?= Html::encode(round($intercontrol_extercontrol, 0) ) ?></td>
                            <?php if($intercontrol_extercontrol >= 61){
                                echo '<td>Высокий уровень</td>';

                            } elseif($intercontrol_extercontrol >= 40){
                                echo '<td>Средний уровень</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Низкий уровень</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Доминирование</th>
                            <td><?= Html::encode($dominance_result) ?></td>
                            <?php if($dominance_result >= 13){
                                echo '<td>Высокий результат</td>';
                            } elseif($dominance_result >= 6){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Черезвычайно низкий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Ведомость</th>
                            <td><?= Html::encode($statement_result) ?></td>
                            <?php if($statement_result >= 25){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($statement_result >= 12){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row"><p class="text-primary">Интегральный показатель стремления к доминированию</p></th>
                            <td><?= Html::encode(round($dominance_statement, 0) ) ?></td>
                            <?php if($dominance_statement >= 61){
                                echo '<td>Высокий уровень</td>';

                            } elseif($dominance_statement >= 40){
                                echo '<td>Средний уровень</td>';
                                
                            } else{
                                echo '<td><p class="text-danger">Низкий уровень</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Эскапизм</th>
                            <td><?= Html::encode($escapism_result) ?></td>
                            <?php if($escapism_result >= 21){
                                echo '<td><p class="text-danger">Высокий результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Патологический');
                                    $model->save(false);
                                }
                            } elseif($escapism_result >= 10){
                                echo '<td>Зона неопределенности</td>';
                                
                            } else{
                                echo '<td>Черезвычайно низкий результат</td>';
                            }?>
                        </tr>
                        <tr>
                            <th scope="row">Шкала искренности</th>
                            <td><?= Html::encode($deceit_deceit1) ?></td>
                            <?php if($deceit_deceit1 >= 37){
                                echo '<td><p class="text-danger">Недостоверный результат</p></td>';
                                if($model->status_testing_id == StatusTestingUser::getStatusTestingId('Адаптивный')){
                                    $model->status_testing_id = StatusTestingUser::getStatusTestingId('Экстремальный');
                                    $model->save(false);
                                }
                            } else{
                                echo '<td><p class="text-success">Достоверный результат</p></td>';
                            }?>
                        </tr>
                        
                    </tbody>

                </table>
            </li>
            <li class="list-group-item testing-card">Если Вас что-то беспокоит, рекомендуем обратиться к специалисту.</li>
        </ul>
    </div>


</div>
