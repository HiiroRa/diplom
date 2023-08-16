<?php

use app\models\Group;
use app\models\Role;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
?>
<div class="user-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К панели администратора', ['/admin'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
        </h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="mt-3">{pager}</div>{items}<div class="mt-3">{pager}</div>',
        'pager' =>['class'=> LinkPager::class],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
            ],

            [
                'attribute' => 'name',
                'filter' => false,
            ],
            'surname',
            
            [
                'attribute' => 'patronymic',
                'filter' => false,
            ],
            
            [
                'attribute' =>'email',
                'filter' => false,
            ],
            [
                'attribute' => 'login',
                'filter' => false,
            ],
            
            //'password',
            //'auth_key',
            
            [
                'attribute' => 'role_id',
                'value' => function($model){
                    return Html::encode(Role::getRoleName($model->role_id));
                },
                'filter' => $roleList,
            ],
            [
                'attribute' => 'group_id',
                'value' => function($model){
                    if($model->group_id){
                        $val = Html::encode(Group::getGroupName($model->group_id));
                    } else { 
                        $val = '<p>Не студент</p>';
                    };
                    return $val;
                },
                'format' => 'raw',
                'filter' => $groupList,
            ],
            [
                'label'=>'Действия',
                'value' => function($model){
                    $btn_admin = $model->role_id == Role::getRoleId('user') ? Html::a('Назначить администратором', ['appoint', 'id'=>$model->id], ['class' => 'btn btn-outline-success  btn-sm me-2 mt-2']) : '';

                    $btn_psycho = $model->role_id == Role::getRoleId('user') ? Html::a('Назначить психологом', ['psycho', 'id'=>$model->id], ['class' => 'btn btn-outline-success  btn-sm me-2 mt-2']) : '';

                    $btn_del = Html::a('Удалить', ['delete', 'id'=>$model->id], ['class' => 'btn btn-outline-danger btn-sm mt-2', 'data-method'=> 'post']);

                    return '<div class="row m-1">'.
                                $btn_admin.
                                $btn_psycho .
                                $btn_del .
                            '</div>';
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>
