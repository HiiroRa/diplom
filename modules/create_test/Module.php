<?php

namespace app\modules\create_test;

/**
 * create_test module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\create_test\controllers';

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
