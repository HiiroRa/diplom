<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\create_test\models\TypeQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление ответами';
?>
<div class="answer-question-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">            
        <?= Html::a('К созданию тестов', ['default/index'], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('К вопросам', ['question/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= Html::a('Создать новый ответ', ['create', 'id'=> $idQuestion], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <h2>Вопрос №<?= Html::encode($idQuestion) ?>:  <?= Html::encode($titleQuestion) ?></h2>


    <h3>Список ответов:</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '<div class="mt-3">{pager}</div><div class="row">{items}</div><div class="mt-3">{pager}</div>',
        'pager' =>['class'=> LinkPager::class],
        'filterModel' => $searchModel,
        'columns' => [
            // [
            //     'label'=>'Необходимое количество ответов',
            //     'value' => function($model){
            //         return $model->question->count_answers;
            //     },
            //     'filter' => false,
            // ],
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'attribute'=>'title',
                'filter' => false,
            ],
            [
                'attribute'=>'value',
                'filter' => false,
            ],
            // [
            //     'attribute'=>'question_id',
            //     'filter' => false,
            // ],
            // [
            //     'label'=>'Текст вопроса',
            //     'value' => function($model){
            //         return $model->question->title;
            //     },
            //     'filter' => false,
            // ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]);
    
     ?>


</div>
