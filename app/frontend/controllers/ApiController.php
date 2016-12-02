<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use components\com\Man;
use components\com\WoMan;

/**
 * Site controller
 */
class ApiController extends Controller
{

    public function init()
    {
        parent::init();
    }


    public function actionIndex()
    {
       echo "api index ...";
       $man = Man::install();
       $woMan = WoMan::install();
       $woMan->getName();
       p($man, $woMan,  $woMan->getName());
    }

}
