<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
