
<?php

use yii\bootstrap5\Html;

$this->title = 'Тесты';
$randomString = Yii::$app->security->generateRandomString(32);
?>

<div class="row p-4 test-card rounded mt-3">
    <div class="  text-dark">
        <div class="col-xxl-12">
        <h2><?= $model->title?></h2>
        <p class="lead"><?= $model->description?></p>
        <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ? Html::a('Пройти тест', ['view', 'id' => $model->id,], ['class' => 'btn btn-outline-success me-2', 'data'=>[
            'method'=> 'post',
            'params' => [
                'question_id' => 1,
                'randomString' => $randomString
            ]
        ]]):''?>
        </div>
    </div>
</div>
