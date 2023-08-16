<?php

use app\models\StatusRequest;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы';
?>
<div class="request-index">
        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К кабинету психолога', ['/psycho'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="mt-3">{pager}</div><div class="row">{items}</div><div class="mt-3">{pager}</div>',
        'pager' =>['class'=> LinkPager::class],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //[
            //    'attribute' => 'id',
            //    'filter' => false,
            //],
            [
                'label' => 'Дата',
                'value' => function($model){
                    return Html::encode($model->timestamp);
                },
                'format' => ['date', 'php:d-m-Y H:i:s'],
                'headerOptions' => ['class' => 'd-none d-xl-table-cell'],
                'filterOptions' => ['class' => 'd-none d-xl-table-cell'],
                'contentOptions' =>['class' => 'd-none d-xl-table-cell'],
                
            ],
            [
                'attribute' => 'status_request_id',
                'value' => fn($model)=>$statusRequestList[$model->status_request_id],
                'filter' => $statusRequestList,
            ],
            [
                'label' => 'ФИО',
                'value' => function($model){
                    return $model->user->name  . ' ' . $model->user->patronymic . ' ' .  $model->user->surname;
                },
            ],
            [
                'label' => 'Группа',
                'value' => fn($model) => $groupList[$model->user->group_id],
            ],
            [
                'attribute' => 'title',
                'filter' => false,
            ],

            
            [
                'attribute' => 'test_response',
                'value' => function($model){
                    if($model->test_response){
                        $val = '<p class="text-success"> Ответ отправлен</p>';
                    } else { 
                        $val = '<p class="text-danger"> Ждет Вашего ответа</p>';
                    };
                    return $val;
                },
                'format' => 'raw',
                'filter' => false,
            ],
            [
                'label' => 'Управление запросами',
                'value' => function ($model){
                    $btn_view = Html::a('Просмотреть', ['view','id'=> $model->id], ['class' => 'btn btn-outline-primary me-3']);

                    $btn_answer = $model->status_request_id == StatusRequest::getStatusRequestId('Новый') ?  Html::a('Ответить', ['update','id'=> $model->id], ['class' => 'btn btn-outline-success me-3 mt-2']): '';

                    return $btn_view . $btn_answer;
                },
                'format' => 'raw',
            ],

        ],
    ]); ?>


</div>
