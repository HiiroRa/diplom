<?php

use app\models\StatusRequest;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">
        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К запросам', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= $model->status_request_id == StatusRequest::getStatusRequestId('Новый') ? Html::a('Ответить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-success']): '' ?>

    </p>

        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Дата',
                'value' => function($model){
                    return Html::encode($model->timestamp);
                },
                'format' => ['date', 'php:d-m-Y H:i:s'],
                
            ],
            [
                'attribute' => 'status_request_id',
                'value' => fn($model)=>$statusRequestList[$model->status_request_id],
            ],
            [
                'label' => 'ФИО',
                'value' => function($model){
                    return $model->user->name  . ' ' . $model->user->patronymic . ' ' .  $model->user->surname;
                },
            ],
            'title',
            'text_request',
            [
                'attribute' => 'test_response',
                'value' => function($model){
                    if($model->test_response){
                        $val = $model->test_response;
                    } else { 
                        $val = '<p class="text-danger"> Ждет Вашего ответа</p>';
                    };
                    return $val;
                },
                'format' => 'raw',
                'filter' => false,
            ],
            
            ],
        ]) ?>


</div>
