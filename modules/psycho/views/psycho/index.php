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

$count_request = Request::find()->where(['status_request_id'=>StatusRequest::getStatusRequestId('Новый')])->count();

$count_post = Article::find()->count();

$count_test = Test::find()->count();

$count_student = User::find()->joinWith('testingUsers')->where(['role_id'=>Role::getRoleId('user'), 'status_testing_id' => StatusTestingUser::getStatusTestingId('Патологический')])->orWhere(['status_testing_id' => StatusTestingUser::getStatusTestingId('Экстремальный')])->groupBy(['user_id'])->count();



$this->title = 'Личный кабинет психолога';
?>
	<div class="wrapper">
		<main class="content">
			<div class="container-fluid p-0">
				<h2 class="pb-3 mb-4 font-italic border-bottom">
				Личный кабинет психолога
				</h2>
					<div class="row">
							<div class="w-100">
								<div class="row">
									<div class="col-xl-3 col-md-6 pe-0">
										<div class="card mt-1 mb-3 card-admin">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Новые запросы</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3 text-danger"><?=$count_request?></h1>
												<div class="mb-0">
												<?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('К запросам', ['request/index'], ['class' => 'btn btn-outline-success btn-sm']):''?>
												</div>
											</div>
										</div>                                       
									</div>
                                    
									<div class="col-xl-3 col-md-6 pe-0">
										<div class="card mt-1 mb-3 card-admin">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Студенты</h5>
													</div>
												</div>
												<h1 class="mt-1 mb-3 text-danger"><?=$count_student?></h1>
												<div class="mb-0">
												<?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('К студентами', ['student/index'], ['class' => 'btn btn-outline-success btn-sm']):''?>
												</div>
											</div>
										</div>
									</div>

										<div class="col-xl-3 col-md-6 pe-0">
											<div class="card mt-1 mb-3 card-admin">
												<div class="card-body">
													<div class="row">
														<div class="col mt-0">
															<h5 class="card-title">Статьи</h5>
														</div>
													</div>
													<h1 class="mt-1 mb-3"><?=$count_post?></h1>
													<div class="mb-0">
													<?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Создать статью', ['/create_blog'], ['class' => 'btn btn-outline-success btn-sm']):''?>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-3 col-md-6 pe-0">
											<div class="card mt-1 mb-3 card-admin">
												<div class="card-body">
													<div class="row">
														<div class="col mt-0">
															<h5 class="card-title">Тесты</h5>
														</div>
													</div>
													<h1 class="mt-1 mb-3"><?=$count_test?></h1>
													<div class="mb-0">
													<?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Создать тест', ['/create_test'], ['class' => 'btn btn-outline-success btn-sm']):''?>
													</div>
												</div>
											</div>
										</div>
   
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 pe-0">
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
                                                    return $model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic;
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
                                                    return Html::a('Просмотреть', ['view', 'id' => $model->id], ['class'=>'btn btn-outline-primary btn-sm']);
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








