<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestForm */
/* @var $form ActiveForm */

$this->title = 'Вопрос психологу';
?>
<div class="site-request">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'text_request')-> textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'timestamp')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false);?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить запрос', ['class' => 'btn btn-outline-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-request -->
