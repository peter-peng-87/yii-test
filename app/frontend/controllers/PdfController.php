<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class PdfController extends Controller
{
    private $data = [];
    /**
     * @var Curl
     */
    private $curl;

    public function init(){
        parent::init();
        // $this->layout = 'empty';
        $this->data = $_REQUEST;
    }
    
    public function actionIndex()
    {
         $font = 'fzbeiwei,FZTJLSJW,hanYuan,msyh,FZBWKSFW,FZY4JW,hanYuanjian,simfang,FZBWKSJW,simhei,FZCSJW,hanJanYuanKai,simkai,simli,stxihei,stingka,stxinwei,stzhongs';
         $fontList = explode(',', $font);
         foreach ($fontList as $f) {
             echo "<a target='_blank' href='http://pdf.y2-front.dev/example_001.php?font={$f}'>{$f}</a><br/>";
         }
    }

   
}
