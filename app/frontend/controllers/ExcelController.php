<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ExcelController extends Controller
{

    public function init()
    {
        parent::init();
    }


    public function actionWrite()
    {
        $excel = new \cy\excel\ExcelReader();
        //$excel->setHeader(['服务工单号' => 'orderNo', '数量' => 'num']);
       // $excel->setAllowEmptyLine(true);
        $excel->parseFile('C:/Users/shop/Desktop/posOrder.xls');
        $data = $excel->getOutResult();
        p($data);
        /**
        $excel = new ExcelWriter();
        $excel->test();
        **/
    }

}
