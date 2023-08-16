<?php

use app\models\Article;
use app\models\Group;
use app\models\Request;
use app\models\Role;
use app\models\StatusRequest;
use app\models\StatusTestingUser;
use app\models\Test;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Тесты студента';
?>
	<div class="wrapper">
		<main class="content">
			<div class="container-fluid p-0">
            <h2 class="pb-3 mb-4 font-italic border-bottom">
                    <?= Html::a('К студентам', ['index'], ['class' => 'btn btn-outline-primary']) ?>
                </h2>
				<h2 class="pb-3 mb-4 font-italic border-bottom">
				Тесты студента
				</h2>

					<div class="row">
						<div class="col-12 ">
							<div class="card flex-fill test-table-admin">
								<div class="card-header">

									<h5 class="card-title mb-0">Сведения о прохождениях тестов</h5>
								</div>
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'layout' => '<div class="mt-3">{pager}</div>{items}<div class="mt-3">{pager}</div>',
                                        'pager' =>['class'=> LinkPager::class],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            //'id',
											[
                                                'attribute' => 'status_testing_id',
                                                'value' => function($model){
                                                    return Html::encode(StatusTestingUser::getStatusTestingName($model->status_testing_id));
                                                },
                                                'filter' => $statusList,
                                            ],
                                            [
                                                'label' => 'ФИО',
                                                'value' => function($model){
                                                    return Html::encode($model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic);
                                                }
                                            ],

                                            [
                                                'label' => 'Группа',
                                                'value' => function($model){
                                                    return Html::encode(Group::getGroupName($model->user->group_id));
													
                                                },
												'headerOptions' => ['class' => 'd-none d-lg-table-cell'],
												'filterOptions' => ['class' => 'd-none d-lg-table-cell'],
												'contentOptions' =>['class' => 'd-none d-lg-table-cell'],
                                            ],
                                            [
                                                'label' => 'Дата',
                                                'value' => function($model){
                                                    return Html::encode($model->date);
                                                },
												'format' => ['date', 'php:d-m-Y H:i:s'],
												'headerOptions' => ['class' => 'd-none d-xl-table-cell'],
												'filterOptions' => ['class' => 'd-none d-xl-table-cell'],
												'contentOptions' =>['class' => 'd-none d-xl-table-cell'],
												
                                            ],
                                            [
                                                'label' => 'Тест',
                                                'value' => function($model){
                                                    return Html::encode(Test::getTestName($model->test_id));
                                                },
                                            ],
                                            
                                            [
                                                'label' => 'Действия',
                                                'value' => function($model){
                                                    return Html::a('Просмотреть', ['psycho/view', 'id' => $model->id], ['class'=>'btn btn-outline-primary btn-sm']);
                                                },
                                                'format' => 'raw',                                                

                                            ],
                                        ],
                                    ]); ?>
							</div>
						</div>
					</div>

				</div>
			</main>
		</div>
	</div>








