<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class JqController extends Controller
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
            'index' => [
                'class' => 'frontend\controllers\action\IndexAction'
            ],
            'extend' => [
                'class' => 'frontend\controllers\action\jquery\ExtendAction'
            ],
            'extendobj' => [
                'class' => 'frontend\controllers\action\jquery\ExtendObjAction'
            ],
        ];
    }
}
