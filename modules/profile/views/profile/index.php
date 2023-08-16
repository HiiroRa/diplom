<?php

use app\models\Request;
use app\models\StatusRequest;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\profile\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личный кабинет пользователя';

$count_new_request = Request::find()->where(['status_request_id'=>StatusRequest::getStatusRequestId('Отвечено'), 'user_id'=> Yii::$app->user->id])->count();
$count_request = Request::find()->where(['user_id'=> Yii::$app->user->id])->count();
?>
<div class="testing-user-index">

<div class="wrapper">
		<main class="content">
			<div class="container-fluid p-0">
				<h2 class="pb-3 mb-4 font-italic border-bottom">
				Личный кабинет пользователя
				</h2>
					<div class="row">
						<div class="w-100">
							<div class="row">
								<div class="col-lg-6">
									<div class="card mt-1 mb-3 card-admin">
										<div class="card-body">
											<div class="row">
												<div class="col mt-0">
													<h5 class="card-title">Ваши запросы (Всего: <?= $count_request ?>)</h5>
												</div>

												<div class="col-auto">
													<div class="stat text-primary">
														<i class="align-middle" data-feather="truck"></i>
													</div>
												</div>
											</div>
											<h4 class="mt-1 mb-3 text-success">Новых ответов: <?=$count_new_request?></h5>
											<div class="mb-0">
											<?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ? Html::a('Просмотреть', ['request/index'], ['class' => 'btn btn-outline-success btn-sm']):''?>
											</div>
										</div>
									</div>                                       
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
							<div class="col-12 ">
								<div class="card flex-fill test-table-admin">
									<div class="card-header">
										<h5 class="card-title mb-0">Сведения о пройденных тестах</h5>
									</div>
									<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>Дата прохождения</th>
												<th>Пройденный тест</th>
												<th>Действия</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<?= ListView::widget([
												'dataProvider' => $dataProvider,
												'summary' => false,
												'itemOptions' => ['class' => 'item'],
												'itemView' => 'table',
											]) ?>
										</tbody>
									</table>
								</div>
							</div>
						
                        
                    </div>
            </div>
        </main>
</div>
