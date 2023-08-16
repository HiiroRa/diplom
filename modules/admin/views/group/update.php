<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = 'Редактировать группу №' . $model->title;
?>
<div class="group-update">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К управлению группами', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
        </h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
