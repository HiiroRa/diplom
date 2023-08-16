<?php

use app\models\CategoryArticle;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\create_blog\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление статьями';
?>
<div class="article-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К управлению созданием статей', ['default/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>
    
    <p>
        <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="mt-3">{pager}</div><div class="row">{items}</div><div class="mt-3">{pager}</div>',
        'pager' =>['class'=> LinkPager::class],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'category_article_id',
                'value' => function($model){
                    return Html::encode(CategoryArticle::getCategoryArticleNeme($model->category_article_id));
                },
                'filter' => $categoryArticleList,
            ],
            'timestamp',
            //'user_id',
            'title',
            //'img',
            'description',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
