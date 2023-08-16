<?php

namespace app\modules\testing;

use Yii;

/**
 * testing module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\testing\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->session->open();
        // custom initialization code goes here
    }
}
