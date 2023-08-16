<?php

use app\models\Group;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Студенты, нуждающиеся во внимании';
?>
<div class="user-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::a('К кабинету психолога', ['/psycho'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>

        <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
        </h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <div class="row">
						<div class="col-12 ">
							<div class="card flex-fill test-table-admin">
								<div class="card-header">

									<h5 class="card-title mb-0">Информация о студентах</h5>
								</div>
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
                                                'attribute' => 'email',
                                                'filter' => false,
                                            ],
                                            
                                            //'login',
                                            //'password',
                                            //'auth_key',
                                            //'role_id',
                                            [
                                                'attribute' => 'group_id',
                                                'value' => function($model){
                                                    return Html::encode(Group::getGroupName($model->group_id));
                                                },
                                                'filter' => $groupList,
                                            ],
                                            
                                            [
                                                'label' => 'Действия',
                                                'value' => function($model){
                                                    return Html::a('К тестам', ['tests', 'id'=>$model->id], ['class' => 'btn btn-outline-primary btn-sm']);
                                                },
                                                'format' => 'raw',
                                            ],
                                        ],
                                    ]); ?>
    						</div>
						</div>
					</div>


</div>
