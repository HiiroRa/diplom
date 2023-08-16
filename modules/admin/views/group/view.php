<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="group-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К управлению группами', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            Группа №<?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>

</div>
