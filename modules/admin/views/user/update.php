<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Редактировать пользователя: ' . $model->name;
?>
<div class="user-update">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К управлению пользователями', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
        </h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
