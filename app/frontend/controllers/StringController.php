<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class StringController extends Controller
{

    public function init()
    {
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
            ]
        ];
    }

    public function actionWord()
    {
        echo "word start ...." . "<br/>";
        // echo $this->convertUnderline("abc_hello_Daaa_sd", false);
        $string = ' $abc_dfdf_0;   hahah $get_Goods abc(';
        echo "source:$string" . "<br/>";
        $match_list = [];
        preg_match_all('/(\$\w+)([\s\]\=\;]+)/is', $string, $match_list);
        foreach ($match_list[1] as $value) {
            $string = str_replace($value, $this->convertUnderline($value, false), $string);
        }
        echo "replace:" . $string;
        // echo preg_replace('/\$(\w+)([\s\]\=\;]+)/is', '$1' , $this->convertUnderline($1));
    }

    public function actionFile()
    {
        /**
         * $string = file_get_contents('D:/wnmp/www/gitapi/cheyiweb/b2c-api/app/modules/preorder/models/form/order/OrderListForm.php');
         * $match_list = [];
         * preg_match_all('/(\$\w+)([\s\]\=\;]+)/is', $string, $match_list);
         * foreach ($match_list[1] as $value) {
         * $string = str_replace($value, $this->convertUnderline($value, false), $string);
         * }
         * file_put_contents("D:/wnmp/www/gitapi/cheyiweb/b2c-api/app/modules/preorder/models/form/order/OrderListForm.php", $string);
         */
        $string = 'var $hello_world; var $goods_list=23434;  $min_data $item_987_op';
        $string = 'var $hello_world;
    var $goods_list=234;
    $min_goods_num = 87;
    $item_987_op ;
    $index_num = 2;
    echo $goods_store[$index_num]
    ';
        $string = file_get_contents('D:/wnmp/www/gitapi/cheyiweb/b2c-api/app/modules/preorder/models/form/order/OrderListForm.php');
        $string =  preg_replace('/(\$\w+)([\s\]\=\;]+)/ies', "\$this->convertUnderline('\\1', false).'\\2'", $string);
        $string =  preg_replace('/(\'\w+)([\']+)/ies', "\$this->convertUnderline('\\1', false).'\\2'", $string);
        file_put_contents("D:/wnmp/www/gitapi/cheyiweb/b2c-api/app/modules/preorder/models/form/order/OrderListForm.php", $string);
    }
    
    // 将下划线命名转换为驼峰式命名
    function convertUnderline($str, $ucfirst = true)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        $str = str_replace(' ', '', lcfirst($str));
        $str = $ucfirst ? ucfirst($str) : $str;
        return $str;
    }
}
