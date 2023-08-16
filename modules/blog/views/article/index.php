<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
?>
<div class="article-index">

        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>


    <?php echo $this->render('_search', ['model' => $searchModel, 'categoryList' => $categoryList,]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemOptions' => ['class' => 'item p-0 '],
        'itemView' => '_card',
    ]) ?>


</div>
