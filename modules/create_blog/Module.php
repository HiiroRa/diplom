<?php

namespace app\modules\create_blog;

/**
 * create_blog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\create_blog\controllers';

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
