<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = $testTitle;

\yii\web\YiiAsset::register($this);
?>
<div class="test-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('Назад к тестам', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>


<div class="view-test">

        <p class="pb-3 mb-4 font-italic border-bottom text-danger">
          Внимание, Ваши ответы будут записаны только после полного прохождения теста! <br> Не переходите на другие вкладки на сайте.
        </p>

    <h4 class="card-title mb-3 p-4"><?= Html::encode($current_question) ?>/<?= Html::encode($countQuestions) ?>: <?= Html::encode($questionTitle) ?></h4>
        <div class="form-check form-check-inline">
        <?php $form = ActiveForm::begin([
                'id' => 'test-form',
            ]);?>

            <?= $form->field($modelAnswerUser, 'answer_value')->radioList($answers, ['class'=>'mt-2'])->label(false)?>
            <?= $form->field($modelAnswerUser, 'auth_key')->hiddenInput(['value' => $randomString],)->label(false)?>
            <?= $form->field($modelAnswerUser, 'question_id')->hiddenInput(['value' => $current_question])->label(false)?>


           
        </div>
        <div class="d-grid gap-2 d-md-block mt-3">
            <?= Html::submitButton('Ответить', ['class' => 'btn btn-outline-success me-2'])?>
        </div>
</div>

<?php ActiveForm::end(); ?>
</div>
