<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Ответ на запрос студента: ' . $model->title;
?>
<div class="request-update">
        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К запросам', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

        <h5>
          Текст запроса:
        </h5>

        <p class="mb-4">
          <?= Html::encode($model->text_request) ?>
        </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
