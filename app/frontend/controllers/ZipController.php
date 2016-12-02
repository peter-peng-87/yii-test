<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ZipController extends Controller
{

    public function init(){
        parent::init();
        // $this->layout = 'empty';
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'js' => [
                'class' => 'frontend\controllers\action\zip\JsAction'
            ],
            'css' => [
                'class' => 'frontend\controllers\action\zip\CssAction'
            ]
        ];
    }
}
