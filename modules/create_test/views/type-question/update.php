<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerQuestion */

$this->title = 'Редактирвоать вариант ответа: ' . $model->title;

?>
<div class="answer-question-update">

        <h2 class="pb-3 mb-4 font-italic border-bottom">            
        <?= Html::a('К управлению вариантами ответов', ['type-question/index','id'=> $model->question_id], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>


    <?= $this->render('_form', [
        'model' => $model,
        'questionList' => $questionList,
        'idQuestion' => $idQuestion,
    ]) ?>

</div>
