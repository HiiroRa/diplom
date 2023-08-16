<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryArticle */

$this->title = 'Создание новой категории статей';
?>
<div class="category-article-create">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К управлению категориями статей', ['category-article/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
