<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1></h1>

    
<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 blog-main">
          <h2 class="pb-3 mb-4 font-italic border-bottom">
          
            <?= Html::a('К статьям', ['article/index'], ['class'=>'btn btn-outline-primary']) ?>
          </h2>
          <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?= Html::encode($this->title) ?>
          </h2>

          <div class="blog-post">
            
            <p class="blog-post-meta">Дата создания: <?= Html::encode(Yii::$app->formatter->asDate( $model->timestamp, 'php:d-m-Y H:i:s')) ?></p>

            <p class="text-start"><?= $model->content ?> </p>
   
          </div><!-- /.blog-post -->
          

        </div><!-- /.blog-main -->


    </div><!-- /.row -->

</main><!-- /.container -->


</div>
