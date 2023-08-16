<?php

use app\models\CategoryTest;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="test-view">

        <h2 class="pb-3 mb-4 font-italic border-bottom">            
        <?= Html::a('К управлению тестами', ['test/index'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'category_test_id',
                'value' => function($model){
                    return Html::encode(CategoryTest::getCategoryTestName($model->category_test_id));
                }
            ],
        ],
    ]) ?>

</div>
