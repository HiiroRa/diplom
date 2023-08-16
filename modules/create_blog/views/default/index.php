<?php

use yii\bootstrap5\Html;

$this->title = 'Управление созданием статей';
?>
<div class="create_blog-default-index">
        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К кабинету психолога', ['/psycho'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>
    <div>
        <div>
            <h5 class="mt-3">Для создания статьи сначала необходимо создать ее категорию, если не подходит ни одна из уже существующих:</h5>
            <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Управление категорями статей', ['category-article/index'], ['class' => 'btn btn-outline-success mt-2']):''?>
        </div>

        <div>
            <h5 class="mt-3">Затем можно создать статью и её наполнение:</h5>
            <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Управление статьями', ['article/index'], ['class' => 'btn btn-outline-success mt-2']):''?>
        </div>

        
        
    </div>
</div>
