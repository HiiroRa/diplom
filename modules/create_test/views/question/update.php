<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Редактировать вопрос: ' . $model->title;
?>
<div class="question-update">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К управлению вопросами', ['question/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryQuestionList' => $categoryQuestionList,
        'testList' => $testList,
    ]) ?>

</div>
