<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'category_article_id')-> dropDownList($categoryList) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-outline-success']) ?>
        <?= Html::a('Сбросить',['index'],  ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
