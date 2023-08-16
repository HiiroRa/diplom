<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryTest */

$this->title = 'Редактирование категории теста: ' . $model->title;
?>
<div class="category-test-update">

        <h2 class="pb-3 mb-4 font-italic border-bottom">            
        <?= Html::a('К списку категорий тестов', ['category-test/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
