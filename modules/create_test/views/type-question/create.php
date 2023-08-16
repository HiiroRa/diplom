<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerQuestion */

$this->title = 'Создать новый вариант ответа';
?>
<div class="answer-question-create">

    <h2 class="pb-3 mb-4 font-italic border-bottom">            
        <?= Html::a('К управлению вариантами ответов', ['type-question/index','id'=> $idQuestion], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <h2>Вопрос №<?= Html::encode($idQuestion) ?>:  <?= Html::encode($titleQuestion) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'questionList' => $questionList,
        'idQuestion' => $idQuestion,
    ]) ?>

</div>
