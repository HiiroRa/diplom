<?php

use app\models\StatusRequest;
use yii\helpers\Html;
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
          Тема запроса: <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= $model->status_request_id == StatusRequest::getStatusRequestId('Новый') ?  Html::a('Удалить', ['delete','id'=> $model->id], ['class' => 'btn btn-outline-danger me-3 mt-2', 'data-method'=> 'POST']): '' ?> 
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Дата',
                'value' => function($model){
                    return Html::encode($model->timestamp);
                },
                'format' => ['date', 'php:d-m-Y H:i:s'],
                
            ],

            [
                'attribute' => 'title',
                'filter' => false,
            ],
            [
                'attribute' => 'text_request',
                'filter' => false,
            ],
            
            [
                'attribute' => 'test_response',
                'value' => function($model){
                    if($model->test_response){
                        $val = $model->test_response;
                    } else { 
                        $val = '<p class="text-danger"> Ожидайте ответа </p>';
                    };
                    return $val;
                },
                'format' => 'raw',
                'filter' => false,
            ],

        ],
    ]) ?>


</div>
