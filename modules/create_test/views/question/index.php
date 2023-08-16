<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\create_test\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление вопросами';
?>
<div class="question-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К созданию тестов', ['default/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= Html::a('Содать новый вопрос', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="mt-3">{pager}</div><div class="row">{items}</div><div class="mt-3">{pager}</div>',
        'pager' =>['class'=> LinkPager::class],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'attribute' => 'id',
                'filter' => false,
            ],

            [
                'attribute' => 'title',
                'filter' => false,
            ],
            
            [
                'attribute' => 'category_question_id',
                'value' => function($model){
                    return $model->categoryQuestion->title;
                },
                'filter' => $categoryQuestionList,
            ],
            [
                'attribute' => 'test_id',
                'value' => function($model){
                    return $model->test->title;
                },
                'filter' => $testList,
            ],
            [
                'label' => 'Подробный просмотр',
                'value' => function ($model){
                    $btn_answer_create = Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"/></svg> Просмотр', ['view','id'=> $model->id], ['class' => 'btn btn-outline-primary']);

                    return $btn_answer_create;
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Управление ответами',
                'value' => function ($model){
                    $btn_answer_create = Html::a('К ответам', ['type-question/index','id'=> $model->id], ['class' => 'btn btn-outline-success ']);

                    return $btn_answer_create;
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
