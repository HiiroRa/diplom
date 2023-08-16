<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';

/* @var $this yii\web\View */
/* @var $model app\models\RegisterForm */
/* @var $form ActiveForm */
?>
<div class="site-register ">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'surname') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'group_id')->dropdownList($groupList) ?>
        <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'login', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        <?= $form->field($model, 'rules')->checkbox() ?>
        
    
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-outline-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
