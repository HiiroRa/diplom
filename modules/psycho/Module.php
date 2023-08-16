<?php

namespace app\modules\psycho;

/**
 * psycho module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\psycho\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->session->open();
        // custom initialization code goes here
    }
}
