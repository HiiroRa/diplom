<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\testing\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тесты';
?>
<div class="test-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <?php echo $this->render('_search', ['model' => $searchModel, 'categoryList' => $categoryList]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_testview',
    ]) ?>


</div>
