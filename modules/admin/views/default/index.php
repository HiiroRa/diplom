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

$count_user = User::find()->count();

$count_group = Group::find()->count();


$this->title = 'Панель администратора';
?>
	<div class="wrapper">
		<main class="content">
			<div class="container-fluid p-0">
				<h2 class="pb-3 mb-4 font-italic border-bottom">
				Панель администратора
				</h2>
					<div class="row">
							<div class="w-100">
								<div class="row">
									<div class="col-xl-6">
										<div class="card mt-1 mb-3 card-admin">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Учебные группы</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$count_group?></h1>
												<div class="mb-0">
												<?= !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin ? Html::a('Управление группами', ['group/index'], ['class' => 'btn btn-outline-success btn-sm']):''?>
												</div>
											</div>
										</div>                                       
									</div>
									<div class="col-xl-6">
										<div class="card mt-1 mb-3 card-admin">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Пользователи</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$count_user?></h1>
												<div class="mb-0">
												<?= !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin ? Html::a('Управление пользователями', ['user/index'], ['class' => 'btn btn-outline-success btn-sm']):''?>
												</div>
											</div>
										</div>                                       
									</div>
							</div>
						</div>
					</div>



				</div>
			</main>
		</div>
	</div>








