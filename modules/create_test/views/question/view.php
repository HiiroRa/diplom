<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="question-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К управлению вопросами', ['question/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'category_question_id',
                'value' => fn($model)=> $categoryQuestionList[$model->category_question_id],
            ],
            [
                'attribute' => 'additional_category_question',
                'value' =>
                function($model) use($categoryQuestionList){
                    if($model->additional_category_question){
                        $val = $categoryQuestionList[$model->additional_category_question];
                    } else { 
                        $val = '<p class="text-danger">Значения нет</p>';
                    };
                    return $val;
                },
                'format' => 'raw',
                'filter' => false,
            ],
            [
                'attribute' => 'test_id',
                'value' => fn($model)=> $testList[$model->test_id],
            ],
            [
                'label' => 'Ответы на вопрос',
                'value' => GridView::widget([
                    'dataProvider' => $data,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'attribute'=>'title',
                            'filter' => false,
                        ],
                        [
                            'label'=>'Значение',
                            'value' => function($model){
                                return $model->value;
                            },
                            'filter' => false,
                        ],
                    ],
                ]),
                'format' => 'raw',
            ],
            [
                'label' => 'Управление ответами',
                'value' => function ($model){
                    $btn_answer_create = Html::a('К управлению ответами',  ['type-question/index','id'=> $model->id], ['class' => 'btn btn-outline-success']);

                    return $btn_answer_create;
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
