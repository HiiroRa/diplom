<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Психологическая служба СПБ ГБ ПОУ «Радиотехнического колледжа»';
?>
<div class="site-index">

<div class="row">
    
    <div class="col-xxl-6">
        <div class="pe-4">
          <h1 class="mb-3">Психологическая служба СПБ ГБ ПОУ «Радиотехнического колледжа» <br></h1>
          <h5 class="card-text mb-3"> В разделе "Статьи" Вы можете ознакомиться с волнующими Вас проблемами и пройти тестирование.</h5>
          <h5 class="card-text mb-3">А также студенты колледжа могут задать вопрос психологу и получить ответ с рекомендациями.</h5>
          <div class="row justify-content-between">
            <div class="col-4">
                <?= Html::a('К статьям', ['/blog'], ['class' => 'btn btn-outline-primary'])?>
            </div> 
            <div class="col-4">
                <?= Html::a('К тестам', ['/testing'], ['class' => 'btn btn-outline-primary'])?>
            </div> 
            <div class="col-4">
                <?= Yii::$app->user->isGuest ? Html::a('Зарегистрироваться', ['site/register'], ['class' => 'btn btn-outline-success me-2']):''?>
            </div>   
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
    <img src="/img/baner.png" class="baner" alt="Счастливые подростки">
    </div>
  </div>
</div>
</div>
