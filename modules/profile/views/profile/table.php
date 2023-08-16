<?php

use app\models\Test;
use yii\bootstrap5\Html;

$testList = Test::getTestList();
?>
<tr>
	<td> <?= Html::encode(Yii::$app->formatter->asDate( $model->date, 'php:d-m-Y H:i:s')) ?></td>
	<td><?= $testList[$model->test_id] ?></td>
	<td><?= Html::a('Просмотреть', ['view', 'id' => $model->id], ['class'=>'btn btn-outline-primary btn-sm'])?></td>
</tr>
						
