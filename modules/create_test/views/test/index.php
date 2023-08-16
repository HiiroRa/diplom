<?php

use app\models\CategoryTest;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\create_test\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление тестами';

?>
<div class="test-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К созданию тестов', ['default/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= Html::a('Создать новый тест', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="mt-3">{pager}</div><div class="row">{items}</div><div class="mt-3">{pager}</div>',
        'pager' =>['class'=> LinkPager::class],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'category_test_id',
                'value' => function($model){
                    return Html::encode(CategoryTest::getCategoryTestName($model->category_test_id));
                }
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
