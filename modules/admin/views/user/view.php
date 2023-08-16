<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name . ' ' . $model->surname . ' ' . $model->patronymic;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К управлению пользователями', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
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
            'name',
            'surname',
            'patronymic',
            'email:email',
            'login',
            //'password',
            //'auth_key',
            'role_id',
            'group_id',
        ],
    ]) ?>

</div>
