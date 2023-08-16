<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Создать статью';
?>
<div class="article-create">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К созданию статей', ['article/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryArticleList' => $categoryArticleList,
    ]) ?>

</div>
