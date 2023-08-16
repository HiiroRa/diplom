<?php

namespace app\modules\profile;

/**
 * profile module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\profile\controllers';

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
