<?php

use yii\bootstrap5\Html;
?>


<div class="row pt-md-4">
	<div class="col-12 mb-3 ">
		<div class="blog-entry d-md-flex">
            <div class=" row rounded blog-card p-3 w-100">
                <div class="col-md-2">
                    <img class="rounded-circle blog me-4" src="<?= Html::encode($model->img) ?>" alt="<?= Html::encode($model->title) ?>">
                </div>
                <div class="col-md-10 mt-2">
                    <div class="text text-2 pl-md-4">
                        <h3 class="mb-2"><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id], ['class'=> 'text-2']) ?></h3>
                            <div class="meta-wrap">
                                <p class="meta card-text">
                                    <span><i class="icon-calendar mr-2 ">Дата создания: <?= Html::encode(Yii::$app->formatter->asDate( $model->timestamp, 'php:d-m-Y H:i:s')) ?></i></span>
                                </p>
                            </div>
                            <div class="row">
                                <h5 class="card-text d-inline-block text-truncate mt-3 mb-3" ><?= Html::encode($model->description) ?></h5>
                                <p>
                                    <?= Html::a('Читать', ['view', 'id' => $model->id], ['class'=>'btn btn-outline-success']) ?> 
                                    <span class="ion-ios-arrow-forward"></span></p>
                            </div>
                                
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
								
