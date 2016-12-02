<?php

namespace frontend\controllers\action\zip;

use Yii;
use yii\base\Action;
use MatthiasMullie\Minify;

class JsAction extends Action
{
	public function init()
	{
		parent::init();
	}

	/**
	 * @return array
	 */
    public function run()
    {
	   // echo "action zip-js now ....!!!";
	    // print_r($result);
	    // $this->smarty->test = 'hahaha';
	    //return $this->controller->render('index.html', $result);
	    /**
	     *   '//ui/jquery-easyui-1.4.2/jquery.min.js',
        '//ns/b2c/member/js/jquery-migrate-1.2.1.min.js',
        '//ui/jquery-easyui-1.4.2/jquery.easyui.min.js',
        '//ui/jquery-easyui-1.4.2/easyui.common.js',
        '//ns/b2c/member/js/ser_common.js',
        '//js/miniui/utils.js',
	     */
	    $minify = new Minify\JS();
	    $minify->add('D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/jquery.min.js');
	    $minify->add('D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/js/jquery-migrate-1.2.1.min.js');
	    $minify->add('D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/jquery.easyui.min.js');
	    $minify->add('D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/easyui.common.js');
	    $minify->add('D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/js/ser_common.js');
	    $minify->add('D:/wnmp/www/gitapi/cheyiweb/static/js/miniui/utils.js');
	   echo  $minify->minify('C:/Users/shop/Desktop/zip.js');die;
	    //$minify->e
    }
}
