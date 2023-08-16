<?php

use app\models\CategoryArticle;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К созданию статей', ['article/index'], ['class' => 'btn btn-outline-primary']) ?>
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
            [
                'attribute' => 'category_article_id',
                'value' => function($model){
                    return Html::encode(CategoryArticle::getCategoryArticleNeme($model->category_article_id));
                }
            ],
            
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return Html::encode($model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic);
                }
            ],
            'title',
            [
                'attribute' => 'img',
                'value' => function($model){
                    return '<img src='.Html::encode($model->img).' class="article w-50" >';
                },
                'format' => 'raw',
            ],
            
            'description',
            'content:html',
            'timestamp',
        ],
    ]) ?>

</div>
