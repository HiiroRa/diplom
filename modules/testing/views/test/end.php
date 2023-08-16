<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'Тест завершен';

\yii\web\YiiAsset::register($this);
?>
<div class="test-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('Назад к тестам', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            Тест завершен
        </h2>

    <h5>Спасибо, что прошли тест.</h5>
    <h5>Результат можете посмотреть в личном кабинете.</h5>
 <p>
    <?= Html::a('К личному кабинету', ['/profile'], ['class' => 'btn btn-outline-primary']) ?>
 </p>



</div>
