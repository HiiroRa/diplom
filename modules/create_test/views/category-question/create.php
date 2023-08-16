<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryQuestion */

$this->title = 'Создать категорию вопросов';
?>
<div class="category-question-create">

        <h2 class="pb-3 mb-4 font-italic border-bottom">            
        <?= Html::a('К управлению категориями вопросов', ['category-question/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?= $this->render('_form', [
        'model' => $model,
        'testList' => $testList,
    ]) ?>

</div>
