<?php
use yii\bootstrap5\Html;

$this->title = 'Создание теста';
?>

<div class="create_test-default-index">
        <h2 class="pb-3 mb-4 font-italic border-bottom">        
        <?= Html::a('К кабинету психолога', ['/psycho'], ['class' => 'btn btn-outline-primary']) ?>
        </h2>
        <h2 class="pb-3 mb-4 font-italic border-bottom">
          <?= Html::encode($this->title) ?>
        </h2>
    <div>
        <div>
            <h5 class="mt-3">Для создания теста сначала необходимо создать его категорию, если не подходит ни одна из уже существующих:</h5>
            <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Создать категорию теста', ['category-test/index'], ['class' => 'btn btn-outline-success mt-2']):''?>
        </div>

        <div>
            <h5 class="mt-3">Затем можно дать ему название и присвоить категорию:</h5>
            <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Создать название теста', ['test/index'], ['class' => 'btn btn-outline-success mt-2']):''?>
        </div>

        <div>
            <h5 class="mt-3">Обязательно нужно обозначить категории вопросов, по которым будет происходить расчет результата:</h5>
            <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Создать категорию вопроса', ['category-question/index'], ['class' => 'btn btn-outline-success mt-2']):''?>
        </div>

        <div>
            <h5 class="mt-3">Создаем вопросы теста:</h5>
            <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && Yii::$app->user->identity->isPsycho ? Html::a('Создать вопросы', ['question/index'], ['class' => 'btn btn-outline-success mt-2 ']):''?>
        </div>

        
        
        
    </div>
    
</div>
